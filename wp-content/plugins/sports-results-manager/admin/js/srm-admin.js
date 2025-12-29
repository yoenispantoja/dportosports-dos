(function($) {
    'use strict';

    $(document).ready(function() {
        var modal = $('#srm-modal');
        var form = $('#srm-result-form');

        // Abrir modal para agregar nuevo resultado
        $('#srm-add-new').on('click', function() {
            form[0].reset();
            $('#result-id').val('');
            $('#srm-modal-title').text('Agregar Nuevo Resultado');
            $('#team1-logo-preview').empty();
            $('#team2-logo-preview').empty();
            modal.fadeIn();
        });

        // Cerrar modal
        $('.srm-modal-close, .srm-cancel-btn').on('click', function() {
            modal.fadeOut();
        });

        // Cerrar modal al hacer clic fuera
        $(window).on('click', function(e) {
            if ($(e.target).is('#srm-modal')) {
                modal.fadeOut();
            }
        });

        // Manejar subida de logos
        $('.srm-upload-logo').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var target = button.data('target');
            var targetInput = $('#' + target);
            var targetPreview = $('#' + target + '-preview');

            // Crear o abrir media uploader
            var customUploader = wp.media({
                title: 'Seleccionar Logo del Equipo',
                button: {
                    text: 'Usar este logo'
                },
                library: {
                    type: 'image'
                },
                multiple: false
            });

            customUploader.on('select', function() {
                var attachment = customUploader.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
                targetPreview.html('<img src="' + attachment.url + '" style="max-width: 100px; height: auto;">');
            });

            customUploader.open();
        });

        // Guardar resultado
        form.on('submit', function(e) {
            e.preventDefault();

            var formData = {
                action: 'srm_save_result',
                nonce: srmAdmin.nonce,
                id: $('#result-id').val(),
                event_name: $('#event-name').val(),
                event_date: $('#event-date').val(),
                sport_type: $('#sport-type').val(),
                team1_name: $('#team1-name').val(),
                team1_abbr: $('#team1-abbr').val(),
                team1_logo: $('#team1-logo').val(),
                team1_score: $('#team1-score').val(),
                team2_name: $('#team2-name').val(),
                team2_abbr: $('#team2-abbr').val(),
                team2_logo: $('#team2-logo').val(),
                team2_score: $('#team2-score').val(),
                status: $('#status').val(),
                post_url: $('#post-url').val(),
                display_order: $('#display-order').val()
            };

            $.ajax({
                url: srmAdmin.ajax_url,
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.data);
                        location.reload();
                    } else {
                        alert('Error: ' + response.data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', xhr.responseText);
                    alert('Error al conectar con el servidor: ' + error + '\nVerifique la consola para más detalles.');
                }
            });
        });

        // Editar resultado
        $(document).on('click', '.srm-edit-btn', function() {
            var resultId = $(this).data('id');

            $.ajax({
                url: srmAdmin.ajax_url,
                type: 'POST',
                data: {
                    action: 'srm_get_result',
                    nonce: srmAdmin.nonce,
                    id: resultId
                },
                success: function(response) {
                    if (response.success) {
                        var result = response.data;
                        $('#result-id').val(result.id);
                        $('#event-name').val(result.event_name);
                        $('#sport-type').val(result.sport_type);

                        // Convertir fecha al formato datetime-local
                        var date = new Date(result.event_date);
                        var formattedDate = date.getFullYear() + '-' +
                            String(date.getMonth() + 1).padStart(2, '0') + '-' +
                            String(date.getDate()).padStart(2, '0') + 'T' +
                            String(date.getHours()).padStart(2, '0') + ':' +
                            String(date.getMinutes()).padStart(2, '0');
                        $('#event-date').val(formattedDate);

                        $('#status').val(result.status);
                        $('#display-order').val(result.display_order);
                        $('#post-url').val(result.post_url || '');
                        $('#team1-name').val(result.team1_name);
                        $('#team1-abbr').val(result.team1_abbr);
                        $('#team1-logo').val(result.team1_logo);
                        $('#team1-score').val(result.team1_score);
                        $('#team2-name').val(result.team2_name);
                        $('#team2-abbr').val(result.team2_abbr);
                        $('#team2-logo').val(result.team2_logo);
                        $('#team2-score').val(result.team2_score);

                        // Mostrar preview de logos
                        if (result.team1_logo) {
                            $('#team1-logo-preview').html('<img src="' + result.team1_logo + '" style="max-width: 100px; height: auto;">');
                        }
                        if (result.team2_logo) {
                            $('#team2-logo-preview').html('<img src="' + result.team2_logo + '" style="max-width: 100px; height: auto;">');
                        }

                        $('#srm-modal-title').text('Editar Resultado');
                        modal.fadeIn();
                    } else {
                        alert('Error: ' + response.data);
                    }
                },
                error: function() {
                    alert('Error al cargar el resultado');
                }
            });
        });

        // Eliminar resultado
        $(document).on('click', '.srm-delete-btn', function() {
            if (!confirm('¿Estás seguro de que deseas eliminar este resultado?')) {
                return;
            }

            var resultId = $(this).data('id');

            $.ajax({
                url: srmAdmin.ajax_url,
                type: 'POST',
                data: {
                    action: 'srm_delete_result',
                    nonce: srmAdmin.nonce,
                    id: resultId
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.data);
                        location.reload();
                    } else {
                        alert('Error: ' + response.data);
                    }
                },
                error: function() {
                    alert('Error al eliminar el resultado');
                }
            });
        });
    });

})(jQuery);
