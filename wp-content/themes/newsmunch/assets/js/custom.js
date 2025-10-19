/**
 * Custom.js File
 *
 * @package     NewsMunch
 * @author      Desert Themes
 * @copyright   Copyright (c) 2024, NewsMunch
 * @link        http://
 * @since       NewsMunch 1.0.0
*/


/*=========================================================================
            Home Slider
=========================================================================*/
jQuery(document).ready(function ($) {

    // post-carousel-banner
    $('.post-carousel-banner').each(function() {
        if( $(this).prev(".widget-header").length > 0 ) {
            $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
            let append_Arrows = $(this).siblings('.widget-header').find('.slick-arrows-top');
            //console.log(append_Arrows);
            $(this).slick({
                dots: true,
                //arrows: true,
                adaptiveHeight: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                /*fade: true,
                cssEase: 'linear',*/
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                rtl: $("html").attr("dir") == 'rtl' ? true : false,
                nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
                prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
                appendArrows: append_Arrows,
                responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false,
                    }
                }
                ]
            });
        } else {
            $(this).slick({
                dots: false,
                arrows: true,
                adaptiveHeight: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                rtl: $("html").attr("dir") == 'rtl' ? true : false,
                responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false,
                    }
                }
                ]
            });
        }
    });

    // post gallery
    $('.post-gallery').each(function() {
        $(this).slick({
            rtl: $('html').attr('dir') != "rtl" ? false : true,
            dots: false,
            arrows: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            cssEase: 'linear',
            infinite: true,
            adaptiveHeight: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                    arrows: true,
                }
            }]
        });
    });
    
    // featured-posts-carousel
    $('.featured-posts-carousel').each(function() {
        $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
        let append_Arrows = $(this).siblings('.widget-header').find('.slick-arrows-top');
        $(this).slick({
            dots: false,
            //arrows: false,
            slidesToShow: 5,
            slidesToScroll: 3,
            infinite: true,
            rtl: $("html").attr("dir") == 'rtl' ? true : false,
            nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
            prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
            appendArrows: append_Arrows,
            responsive: [
                {
                    breakpoint: 1440,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        dots: true,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        dots: true,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                    }
                }
                ,
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                    }
                }
            ]
        });
    });

    $('.posts-vertical-carousel').each(function() {
        $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
        let append_Arrows = $(this).siblings('.widget-header').find('.slick-arrows-top');
        $(this).slick({
            autoplay: true,
            vertical: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            verticalSwiping: true,
            autoplaySpeed: 10000,
            infinite: true,
            nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
            prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
            appendArrows: append_Arrows,
        });
    });

    // post-carousel-threeCol
    $('.post-carousel-threeCol').each(function() {
        $(this).slick({
            rtl: $('html').attr('dir') != "rtl" ? false : true,
            dots: true,
            arrows: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    });

    $('.post-carousel-missed').each(function() {
        $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
        let append_Arrows = $(this).siblings('.widget-header').find('.slick-arrows-top');
        $(this).slick({
            rtl: $('html').attr('dir') != "rtl" ? false : true,
            dots: false,
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: true,
            infinite: true,
            nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
            prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
            appendArrows: append_Arrows,
            responsive: [
                {
                    breakpoint: 1201,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    });

    // post-carousel-widget
    $('.post-carousel-widget').each(function() {
        $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
        let append_Arrows = $(this).siblings('.slick-arrows-bot');
        $(this).slick({
            rtl: $('html').attr('dir') != "rtl" ? false : true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
            prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
            appendArrows: append_Arrows,
            responsive: [
                {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
                },
                {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    slidesToScroll: 1,
                }
                }
            ]
        });
    });

    $('.post-carousel-post_list_sm').each(function() {
        $(this).siblings('.widget-header').append('<div class="slick-arrows-top"></div>');
        let append_Arrows = $(this).siblings('.widget-header').find('.slick-arrows-top');
        $(this).slick({
            rtl: $('html').attr('dir') != "rtl" ? false : true,
            dots: false,
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            adaptiveHeight: true,
            infinite: true,
            nextArrow: '<button type="button" class="slick-next slick-arrow" role="button"></button>',
            prevArrow: '<button type="button" class="slick-prev slick-arrow" role="button"></button>',
            appendArrows: append_Arrows,
            responsive: [
                {
                    breakpoint: 1201,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
    });

    // Video Slider
    $('.dt_video_slider').each(function() {
        $(this).sliderPro({
            width: '100%',
            height: 460,
            arrows: true,
            buttons: false,
            fullScreen: false,
            thumbnailWidth: 160,
            thumbnailHeight: 112,
            thumbnailsPosition: 'bottom',
            autoplay: false,
            fadeArrows: false,
            loop: true,
            breakpoints: {
                1920: {
                    thumbnailWidth: 200,
                    thumbnailHeight: 100,
                    height: 624,
                },
                1600: {
                    thumbnailWidth: 142,
                    thumbnailHeight: 80,
                    height: 467,
                },
                1366: {
                    thumbnailWidth: 142,
                    thumbnailHeight: 110,
                    height: 506,
                },
                1024: {
                    thumbnailWidth: 142,
                    thumbnailHeight: 110,
                    height: 376,
                },
                800: {
                    height: 423,
                    thumbnailsPosition: 'bottom',
                    thumbnailWidth: 142,
                    thumbnailHeight: 110
                },
                500: {
                    height: 239,
                    thumbnailsPosition: 'bottom',
                    thumbnailWidth: 142,
                    thumbnailHeight: 110
                },
                375: {
                    height: 199,
                    thumbnailsPosition: 'bottom',
                    thumbnailWidth: 142,
                    thumbnailHeight: 110
                }
            }
        });
    });

    // Skillbars
    $('.dt_skillbars-main').each(function() {
        $(this).find('.dt_skillbars-line').animate({
            width: $(this).attr('data-percent')
        }, 5000);
        $(this).find('.dt_skillbars-percent').animate({
            left: $(this).attr('data-percent')
        }, 5000);
    });
    $('.dt_skillbars-count').each(function() {
        var self = $(this);
        $({
            Counter: 0
        }).animate({
            Counter: self.text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function() {
                self.text(Math.ceil(this.Counter));
            }
        });
    });

	// Skillbars
    $('.video-popup').each(function() {
        $(this).fancybox({
            openEffect  : 'fade',
            closeEffect : 'fade',
            helpers : {
                media : {}
            }
        });
    });
    
	if($('.wp-block-gallery .wp-block-image a').length) {
		$('.wp-block-gallery .wp-block-image').each(function() {
			// set the rel for each gallery
			$(this).find("a").attr('data-fancybox', 'gallery');
		});
		$('[data-fancybox="gallery"]').fancybox({
			buttons: [
				"slideShow",
				"thumbs",
				"zoom",
				"fullScreen",
				"share",
				"close"
			],
			loop: true,
			protect: true
		});
	}
    
    $('.dt-posts-module.loadon .dt-posts').each(function () {
        $(this).btnloadmore();
    });

    // Cookie Storage
    var cookieStorage = {
        setCookie: function setCookie(key, value, time, path) {
            var expires = new Date();
            expires.setTime(expires.getTime() + time);
            var pathValue = '';
            if (typeof path !== 'undefined') {
                pathValue = 'path=' + path + ';'
            }
            document.cookie = key + '=' + value + ';' + pathValue + 'expires=' + expires.toUTCString()
        },
        getCookie: function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null
        },
        removeCookie: function removeCookie(key) {
            document.cookie = key + '=; Max-Age=0; path=/'
        }
    };

    $('.dt_switcherdarkbtn').click(function() {
        $('.dt_switcherdarkbtn').toggleClass('active');
        if ($('.dt_switcherdarkbtn').hasClass('active')) {
            $('body').addClass('dark');
            cookieStorage.setCookie('yonkovNightMode', 'true', 2628000000, '/');
        } else {
            $('body').removeClass('dark');
            setTimeout(function() {
                cookieStorage.removeCookie('yonkovNightMode');
            }, 100)
        }
    });
    if (cookieStorage.getCookie('yonkovNightMode')) {
        $('body').addClass('dark');
        $('.dt_switcherdarkbtn').addClass('active');
    }

    // Social share toggle
    $('.post button.toggle-button').each( function() {
        $(this).on( 'click', function(e) {
            $(this).next('.social-share:not(.single-post-share) .icons').toggleClass("visible");
            $(this).toggleClass('fa-close').toggleClass('fa-share-nodes');
        });
    });

    // Spacer with Data Attribute
    let spacer = document.getElementsByClassName('spacer');
    for (let i = 0; i < spacer.length; i++) {
      let spacerHeight = spacer[i].getAttribute('data-height');
      spacer[i].style.height = "" + spacerHeight + "px";
    }

    // Background Image with Data Attribute
    let bgimageset = document.getElementsByClassName('data-bg-image');
    for (let i = 0; i < bgimageset.length; i++) {
        let bgimage = bgimageset[i].getAttribute('data-bg-image');
        bgimageset[i].style.backgroundImage = "url('" + bgimage + "')"
    }

    // Tab Content
    $(".dt_tabs").each(function () {
        let myTabs = $(this);
    
        myTabs.find(".dt_tabslist li button").click(function () {
            let myTabsButton = $(this);
    
            // Check if the button is already active
            if (myTabsButton.hasClass("active")) {
                return false; // Ignore repeated clicks
            }
    
            let tab_id = myTabsButton.attr("data-tab");
            myTabs.find(".dt_tabslist li button").removeClass("active");
            myTabs.find(".tab-content .tab-pane").removeClass("active").removeClass("show");
            myTabsButton.addClass("active");
            $("#" + tab_id).addClass("active").addClass("show").addClass("loading");
    
            $('.lds-dual-ring').addClass("loading");
    
            setTimeout(function () {
                $("#" + tab_id).removeClass("loading");
                $('.lds-dual-ring').removeClass("loading");
            }, 500);
    
            return false;
        });
    });

    /*SEARCH BY USING A CITY NAME (e.g. athens) OR A COMMA-SEPARATED CITY NAME ALONG WITH THE COUNTRY CODE (e.g. athens,gr)*/
    if (navigator.geolocation && document.querySelector(".dt-weather .cities")) {
        navigator.geolocation.getCurrentPosition((position) => {
            const list = document.querySelector(".dt-weather .cities");
            const apiKey = "4d8fb5b93d4af21d66a2948710284366";
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;
            const listItems = list.querySelectorAll(".dt-weather .city");
            const listItemsArray = Array.from(listItems);
            if (listItemsArray.length > 0) {
                const filteredArray = listItemsArray.filter(el => {
                    let content = "";
                    if (inputVal.includes(",")) {
                        if (inputVal.split(",")[1].length > 2) {
                            inputVal = inputVal.split(",")[0];
                            content = el
                                .querySelector(".city-name span")
                                .textContent.toLowerCase();
                        } else {
                            content = el.querySelector(".city-name").dataset.name.toLowerCase();
                        }
                    } else {
                        content = el.querySelector(".city-name span").textContent.toLowerCase();
                    }
                    return content == inputVal.toLowerCase();
                });

                if (filteredArray.length > 0) {
                    alert(`You already know the weather for ${
                        filteredArray[0].querySelector(".city-name span").textContent
                    } ...otherwise be more specific by providing the country code as well 😉`);
                    return;
                }
            }
            const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;
            $.getJSON(url, function(data) {
                    const {
                        main,
                        name,
                        sys,
                        weather
                    } = data;
                    const icon = `https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/${
                        weather[0]["icon"]
                    }.svg`;
            const createDiv = document.createElement("div");
            createDiv.classList.add("city");
            const markup = `
                <div class="city-name" data-name="${name},${sys.country}">
                <span>${name}, ${sys.country}</span>
                </div>
                <div class="city-temp">${Math.round(main.temp)} °C </div>
                <div class="city-description">
                <span class="icon"><img src="${icon}" alt="${
                    weather[0]["description"]
                }"></span>
                <span class="text">${weather[0]["description"]}</span>
                </div>
            `;
                    createDiv.innerHTML = markup;
                    list.appendChild(createDiv);
            })
        });
    } else {
        $(".dt-weather").html("Geolocation is not supported by this browser.");
    }

    /*Time*/
    setInterval(function() {
        var mydate = new Date();
        $(".dt-time").html( mydate.toLocaleTimeString() );
    }, 100);

    if ( $('.marquee').hasClass('flash-slide-right') ) {
        $('.marquee.flash-slide-right').marquee({
            //duration in milliseconds of the marquee
            speed: 80000,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            //direction: 'right',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover: true,
            startVisible: true
        });
    }

    if ( $('.marquee').hasClass('flash-slide-left') ) {
        $('.marquee.flash-slide-left').marquee({
            //duration in milliseconds of the marquee
            speed: 80000,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            //direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover: true,
            startVisible: true
        });
    }

    //var $status = $('.status');
    $('.post-carousel-banner').imagesLoaded({
        background: '.data-bg-image'
    }, function( imgLoad ) {
        //$status.text( imgLoad.images.length + ' images loaded checking .box backgrounds' );
        //console.log(imgLoad.images.length);
    }
    );

    /*var imgLoad = imagesLoaded('body');
    imgLoad.on( 'always', function() {
    console.log( imgLoad.images.length + ' images loaded' );
    // detect which image is broken
    for ( var i = 0, len = imgLoad.images.length; i < len; i++ ) {
        var image = imgLoad.images[i];
        var result = image.isLoaded ? 'loaded' : 'broken';
        console.log( 'image is ' + result + ' for ' + image.img.src );
    }
    });*/
    // Accordion
    $(document).on("click", ".accordion__title", function () {
        const accordionWrapper = $(this).parent();
        const accordionContent = $(this).parent().find(".accordion__content").first();
        const accordionOpen = "accordion--open";

        // If this accordion is already open
        if (accordionWrapper.hasClass(accordionOpen)) {
            accordionContent.slideUp(); // Close the content.
            accordionWrapper.removeClass(accordionOpen); // Remove the accordionm--open class.
        } else {
            accordionContent.slideDown(); // Show this accordion's content.
            accordionWrapper.addClass(accordionOpen); // Add the accordion--open class.
        }
    });
});

( function( $ ) {
    'use strict';

    //set animation timing
    var animationDelay = 2500,
        //loading bar effect
        barAnimationDelay = 3800,
        barWaiting = barAnimationDelay - 3000, //3000 is the duration of the transition on the loading bar - set in the scss/css file
        //letters effect
        lettersDelay = 50,
        //type effect
        typeLettersDelay = 150,
        selectionDuration = 500,
        typeAnimationDelay = selectionDuration + 800,
        //clip effect 
        revealDuration = 600,
        revealAnimationDelay = 1500;

    function initHeadline() {
        //insert <i> element for each letter of a changing word
        singleLetters($('.dt_heading.dt_heading_2').find('b'));
        singleLetters($('.dt_heading.dt_heading_3').find('b'));
        singleLetters($('.dt_heading.dt_heading_8').find('b'));
        singleLetters($('.dt_heading.dt_heading_9').find('b'));
        //initialise headline animation
        animateHeadline($('.dt_heading'));
    }

    function singleLetters($words) {
        $words.each(function() {
            var word = $(this),
                letters = word.text().split(''),
                selected = word.hasClass('is_on');
            for (var i in letters) {
                if (word.parents('.dt_heading_3').length > 0) letters[i] = '<em>' + letters[i] + '</em>';
                letters[i] = (selected) ? '<i class="in">' + letters[i] + '</i>' : '<i>' + letters[i] + '</i>';
            }
            var newLetters = letters.join('');
            word.html(newLetters).css('opacity', 1);
        });
    }

    function animateHeadline($headlines) {
        var duration = animationDelay;
        $headlines.each(function() {
            var headline = $(this);

            if (headline.hasClass('dt_heading_4')) {
                duration = barAnimationDelay;
                setTimeout(function() {
                    headline.find('.dt_heading_inner').addClass('is-loading')
                }, barWaiting);
            } else if (headline.hasClass('dt_heading_6')) {
                var spanWrapper = headline.find('.dt_heading_inner'),
                    newWidth = spanWrapper.width() + 10
                spanWrapper.css('width', newWidth);
            } else if (!headline.hasClass('dt_heading_2')) {
                //assign to .dt_heading_inner the width of its longest word
                var words = headline.find('.dt_heading_inner b'),
                    width = 0;
                words.each(function() {
                    var wordWidth = $(this).width();
                    if (wordWidth > width) width = wordWidth;
                });
                headline.find('.dt_heading_inner').css('width', width);
            };

            //trigger animation
            setTimeout(function() {
                hideWord(headline.find('.is_on').eq(0))
            }, duration);
        });
    }

    function hideWord($word) {
        var nextWord = takeNext($word);

        if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
            var parentSpan = $word.parent('.dt_heading_inner');
            parentSpan.addClass('selected').removeClass('waiting');
            setTimeout(function() {
                parentSpan.removeClass('selected');
                $word.removeClass('is_on').addClass('is_off').children('i').removeClass('in').addClass('out');
            }, selectionDuration);
            setTimeout(function() {
                showWord(nextWord, typeLettersDelay)
            }, typeAnimationDelay);

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_2') || $word.parents('.dt_heading').hasClass('dt_heading_3') || $word.parents('.dt_heading').hasClass('dt_heading_8') || $word.parents('.dt_heading').hasClass('dt_heading_9')) {
            var bool = ($word.children('i').length >= nextWord.children('i').length) ? true : false;
            hideLetter($word.find('i').eq(0), $word, bool, lettersDelay);
            showLetter(nextWord.find('i').eq(0), nextWord, bool, lettersDelay);

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_6')) {
            $word.parents('.dt_heading_inner').animate({
                width: '2px'
            }, revealDuration, function() {
                switchWord($word, nextWord);
                showWord(nextWord);
            });

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_4')) {
            $word.parents('.dt_heading_inner').removeClass('is-loading');
            switchWord($word, nextWord);
            setTimeout(function() {
                hideWord(nextWord)
            }, barAnimationDelay);
            setTimeout(function() {
                $word.parents('.dt_heading_inner').addClass('is-loading')
            }, barWaiting);

        } else {
            switchWord($word, nextWord);
            setTimeout(function() {
                hideWord(nextWord)
            }, animationDelay);
        }
    }

    function showWord($word, $duration) {
        if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
            showLetter($word.find('i').eq(0), $word, false, $duration);
            $word.addClass('is_on').removeClass('is_off');

        } else if ($word.parents('.dt_heading').hasClass('dt_heading_6')) {
            $word.parents('.dt_heading_inner').animate({
                'width': $word.width() + 10
            }, revealDuration, function() {
                setTimeout(function() {
                    hideWord($word)
                }, revealAnimationDelay);
            });
        }
    }

    function hideLetter($letter, $word, $bool, $duration) {
        $letter.removeClass('in').addClass('out');

        if (!$letter.is(':last-child')) {
            setTimeout(function() {
                hideLetter($letter.next(), $word, $bool, $duration);
            }, $duration);
        } else if ($bool) {
            setTimeout(function() {
                hideWord(takeNext($word))
            }, animationDelay);
        }

        if ($letter.is(':last-child') && $('html').hasClass('no-csstransitions')) {
            var nextWord = takeNext($word);
            switchWord($word, nextWord);
        }
    }

    function showLetter($letter, $word, $bool, $duration) {
        $letter.addClass('in').removeClass('out');

        if (!$letter.is(':last-child')) {
            setTimeout(function() {
                showLetter($letter.next(), $word, $bool, $duration);
            }, $duration);
        } else {
            if ($word.parents('.dt_heading').hasClass('dt_heading_2')) {
                setTimeout(function() {
                    $word.parents('.dt_heading_inner').addClass('waiting');
                }, 200);
            }
            if (!$bool) {
                setTimeout(function() {
                    hideWord($word)
                }, animationDelay)
            }
        }
    }

    function takeNext($word) {
        return (!$word.is(':last-child')) ? $word.next() : $word.parent().children().eq(0);
    }

    function switchWord($oldWord, $newWord) {
        $oldWord.removeClass('is_on').addClass('is_off');
        $newWord.removeClass('is_off').addClass('is_on');
    }

    /* ==========================================================================
    When document is loaded, do
    ========================================================================== */
    if ($(".is--sticky").length) {
        let lastScrollTop = 0;
        let isSticky       = $( '.is--sticky' );
        let headerBottom  = isSticky.position().top + $('.dt_header').outerHeight( true );

        const isStickyOn = () => {
            let windowTop  = $( window ).scrollTop();
            // Add custom sticky class
            if ( windowTop >= headerBottom ) {
                isSticky.addClass( 'show' );
            } else {
                isSticky.removeClass( 'show' );
                isSticky.removeClass( 'on' );
            }
            // Show/hide
            if ( isSticky.hasClass( 'show' ) ) {
                if ( windowTop <= headerBottom || windowTop < lastScrollTop ) {
                    isSticky.addClass( 'on' );
                } else {
                    isSticky.removeClass( 'on' );
                }
            }
            lastScrollTop = windowTop;
        };
        
        $( window ).scroll( isStickyOn );
    }

    $( window ).scroll( () => {
        let docHeight = $(".site-wrapper").height();
        let winHeight = $( window ).height();
        let viewport = docHeight - winHeight;
        let scrollPos = $( window ).scrollTop();
        let scrollPercent = ( scrollPos / viewport ) * 100;
        $( ".dt_readingbar" ).css( "width", scrollPercent + "%" );
    });

    // Top Up
    if ($('.dt_uptop').length) {
        var progressPath = document.querySelector('.dt_uptop path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
        var updateProgress = function() {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);
        var offset = 50;
        var duration = 550;
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > offset) {
                $('.dt_uptop').addClass('active');
            } else {
                $('.dt_uptop').removeClass('active');
            }
        });
        $('.dt_uptop').on('click', function(event) {
            event.preventDefault();

            jQuery('html, body').animate({
                scrollTop: 0
            }, duration);
            return false;
        });
    }

    //Hide PreLoading
    if ($(".dt_preloader-close").length) {
        $(".dt_preloader-close").on("click", function(){
            $('.dt_preloader').delay(200).fadeOut(500);
        });
    }
	
	$(window).on('load', function() {
		if($('.dt_preloader').length){
			$('.dt_preloader').delay(1000).fadeOut(500);
		}
        initHeadline();
	});

})( jQuery );