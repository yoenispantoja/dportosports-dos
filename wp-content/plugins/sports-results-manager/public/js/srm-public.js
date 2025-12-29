(function($) {
    'use strict';

    $(document).ready(function() {
        var currentIndex = 0;
        var currentSport = 'all';

        // Calcular cuántas cards se pueden mostrar según el ancho del contenedor
        function getCardsPerView() {
            var carousel = $('.srm-results-carousel');
            var track = $('.srm-results-track');
            var cards = track.find('.srm-result-card:visible');

            if (cards.length === 0) return 1;

            var carouselWidth = carousel.width();
            var cardWidth = cards.first().outerWidth(true); // incluye margin

            if (cardWidth === 0) return 1;

            var cardsVisible = Math.floor(carouselWidth / cardWidth);
            return Math.max(1, cardsVisible);
        }

        // Actualizar carousel
        function updateCarousel() {
            var track = $('.srm-results-track');
            var cards = track.find('.srm-result-card:visible');
            var totalCards = cards.length;

            if (totalCards === 0) return;

            // Recalcular cuántas tarjetas caben
            var cardsPerView = getCardsPerView();

            // Calcular el índice máximo permitido
            var maxIndex = Math.max(0, totalCards - cardsPerView);

            // Asegurar que currentIndex no exceda el máximo
            if (currentIndex > maxIndex) {
                currentIndex = maxIndex;
            }

            // Calcular desplazamiento basado en el ancho real de las tarjetas
            var cardWidth = cards.first().outerWidth(true); // incluye margin
            var offset = -(currentIndex * cardWidth);

            // Aplicar transformación
            track.css('transform', 'translateX(' + offset + 'px)');

            // Actualizar visibilidad de botones
            $('.srm-nav-prev').prop('disabled', currentIndex === 0).css('opacity', currentIndex === 0 ? '0.5' : '1');
            $('.srm-nav-next').prop('disabled', currentIndex >= maxIndex).css('opacity', currentIndex >= maxIndex ? '0.5' : '1');

            // Debug (puedes comentar esto después)
            console.log('Total cards:', totalCards, 'Cards per view:', cardsPerView, 'Max index:', maxIndex, 'Current index:', currentIndex);
        }

        // Navegación anterior
        $('.srm-nav-prev').on('click', function() {
            if (currentIndex > 0) {
                currentIndex--;
                updateCarousel();
            }
        });

        // Navegación siguiente
        $('.srm-nav-next').on('click', function() {
            var track = $('.srm-results-track');
            var cards = track.find('.srm-result-card:visible');
            var cardsPerView = getCardsPerView();
            var maxIndex = Math.max(0, cards.length - cardsPerView);

            if (currentIndex < maxIndex) {
                currentIndex++;
                updateCarousel();
            }
        });

        // Filtrar por deporte - Dropdown
        $('.srm-sport-dropdown').on('change', function() {
            var sport = $(this).val();

            currentSport = sport;
            currentIndex = 0;

            // Hacer petición AJAX
            $.ajax({
                url: srmPublic.ajax_url,
                type: 'POST',
                data: {
                    action: 'srm_filter_results',
                    nonce: srmPublic.nonce,
                    sport: sport
                },
                beforeSend: function() {
                    $('.srm-results-track').css('opacity', '0.5');
                },
                success: function(response) {
                    if (response.success) {
                        $('.srm-results-track').html(response.data);
                        $('.srm-results-track').attr('data-current-sport', sport);
                        $('.srm-results-track').css('opacity', '1');
                        updateCarousel();
                    }
                },
                error: function() {
                    alert('Error al cargar los resultados');
                    $('.srm-results-track').css('opacity', '1');
                }
            });
        });

        // Actualizar en resize
        var resizeTimer;
        $(window).on('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                currentIndex = 0;
                updateCarousel();
            }, 250);
        });

        // Soporte para gestos táctiles
        var startX = 0;
        var isDragging = false;

        $('.srm-results-carousel').on('touchstart', function(e) {
            startX = e.touches[0].pageX;
            isDragging = true;
        });

        $('.srm-results-carousel').on('touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });

        $('.srm-results-carousel').on('touchend', function(e) {
            if (!isDragging) return;

            var endX = e.changedTouches[0].pageX;
            var diff = startX - endX;

            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    // Swipe left - next
                    $('.srm-nav-next').trigger('click');
                } else {
                    // Swipe right - prev
                    $('.srm-nav-prev').trigger('click');
                }
            }

            isDragging = false;
        });

        // Inicializar
        updateCarousel();

        // Hacer tarjetas clicables
        $(document).on('click', '.srm-result-card.srm-clickable', function(e) {
            var url = $(this).data('url');
            if (url) {
                window.location.href = url;
            }
        });

        // Auto-refresh para eventos en vivo (cada 30 segundos)
        setInterval(function() {
            if ($('.srm-live-badge').length > 0) {
                var currentSportFilter = $('.srm-results-track').attr('data-current-sport') || 'all';

                $.ajax({
                    url: srmPublic.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'srm_filter_results',
                        nonce: srmPublic.nonce,
                        sport: currentSportFilter
                    },
                    success: function(response) {
                        if (response.success) {
                            var currentScroll = currentIndex;
                            $('.srm-results-track').html(response.data);
                            currentIndex = currentScroll;
                            updateCarousel();
                        }
                    }
                });
            }
        }, 30000);
    });

})(jQuery);
