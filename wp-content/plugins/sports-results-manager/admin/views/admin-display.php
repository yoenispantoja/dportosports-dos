<?php
$db = new SRM_Database();
$results = $db->get_all_results();
$sport_types = $db->get_sport_types();
?>

<div class="wrap srm-admin-wrap">
    <h1>
        <span class="dashicons dashicons-awards"></span>
        Gestor de Resultados Deportivos
    </h1>

    <div class="srm-admin-container">
        <div class="srm-admin-header">
            <button type="button" class="button button-primary" id="srm-add-new">
                <span class="dashicons dashicons-plus-alt"></span>
                Agregar Nuevo Resultado
            </button>
        </div>

        <div class="srm-results-table-container">
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Evento</th>
                        <th>Deporte</th>
                        <th>Equipos</th>
                        <th>Score</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($results)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">
                                No hay resultados registrados. Haz clic en "Agregar Nuevo Resultado" para comenzar.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($results as $result): ?>
                            <tr data-id="<?php echo esc_attr($result->id); ?>">
                                <td><?php echo esc_html(date('d/m/Y H:i', strtotime($result->event_date))); ?></td>
                                <td><?php echo esc_html($result->event_name); ?></td>
                                <td><span class="srm-sport-badge"><?php echo esc_html($result->sport_type); ?></span></td>
                                <td>
                                    <div class="srm-teams-preview">
                                        <?php if ($result->team1_logo): ?>
                                            <img src="<?php echo esc_url($result->team1_logo); ?>" alt="" class="srm-team-logo-small">
                                        <?php endif; ?>
                                        <span><?php echo esc_html($result->team1_abbr); ?></span>
                                        <span>vs</span>
                                        <?php if ($result->team2_logo): ?>
                                            <img src="<?php echo esc_url($result->team2_logo); ?>" alt="" class="srm-team-logo-small">
                                        <?php endif; ?>
                                        <span><?php echo esc_html($result->team2_abbr); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <strong><?php echo esc_html($result->team1_score); ?></strong> -
                                    <strong><?php echo esc_html($result->team2_score); ?></strong>
                                </td>
                                <td><?php echo esc_html($result->status); ?></td>
                                <td>
                                    <button type="button" class="button button-small srm-edit-btn" data-id="<?php echo esc_attr($result->id); ?>">
                                        <span class="dashicons dashicons-edit"></span>
                                    </button>
                                    <button type="button" class="button button-small srm-delete-btn" data-id="<?php echo esc_attr($result->id); ?>">
                                        <span class="dashicons dashicons-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para agregar/editar resultados -->
    <div id="srm-modal" class="srm-modal" style="display: none;">
        <div class="srm-modal-content">
            <span class="srm-modal-close">&times;</span>
            <h2 id="srm-modal-title">Agregar Resultado</h2>

            <form id="srm-result-form">
                <input type="hidden" id="result-id" name="id" value="">

                <div class="srm-form-row">
                    <div class="srm-form-group">
                        <label for="event-name">Nombre del Evento *</label>
                        <input type="text" id="event-name" name="event_name" required
                               placeholder="Ej: MLB, La Liga, Eurocopa">
                    </div>

                    <div class="srm-form-group">
                        <label for="sport-type">Tipo de Deporte *</label>
                        <input type="text" id="sport-type" name="sport_type" required
                               placeholder="Ej: MLB, NBA, La Liga, SNB" list="sport-types-list">
                        <datalist id="sport-types-list">
                            <?php foreach ($sport_types as $sport): ?>
                                <option value="<?php echo esc_attr($sport); ?>">
                            <?php endforeach; ?>
                            <option value="MLB">
                            <option value="NBA">
                            <option value="La Liga">
                            <option value="SNB">
                            <option value="UEFA">
                        </datalist>
                    </div>
                </div>

                <div class="srm-form-row">
                    <div class="srm-form-group">
                        <label for="event-date">Fecha del Evento *</label>
                        <input type="datetime-local" id="event-date" name="event_date" required>
                    </div>

                    <div class="srm-form-group">
                        <label for="status">Estado</label>
                        <select id="status" name="status">
                            <option value="scheduled">Programado</option>
                            <option value="live">En Vivo</option>
                            <option value="finished">Finalizado</option>
                        </select>
                    </div>

                    <div class="srm-form-group">
                        <label for="display-order">Orden de visualización</label>
                        <input type="number" id="display-order" name="display_order" value="0" min="0">
                    </div>
                </div>

                <div class="srm-form-row">
                    <div class="srm-form-group" style="flex: 1 1 100%;">
                        <label for="post-url">URL del Post Relacionado (opcional)</label>
                        <input type="url" id="post-url" name="post_url"
                               placeholder="Ej: https://ejemplo.com/analisis-del-partido">
                        <small style="color: #666;">Si agregas una URL, los usuarios podrán hacer clic en el resultado para ver más detalles.</small>
                    </div>
                </div>

                <h3>Equipo 1</h3>
                <div class="srm-form-row">
                    <div class="srm-form-group">
                        <label for="team1-name">Nombre Completo *</label>
                        <input type="text" id="team1-name" name="team1_name" required
                               placeholder="Ej: New York Yankees">
                    </div>

                    <div class="srm-form-group">
                        <label for="team1-abbr">Sigla *</label>
                        <input type="text" id="team1-abbr" name="team1_abbr" required
                               placeholder="Ej: NYY" maxlength="10">
                    </div>

                    <div class="srm-form-group">
                        <label for="team1-score">Score</label>
                        <input type="text" id="team1-score" name="team1_score"
                               placeholder="Ej: 0-0, 3">
                    </div>
                </div>

                <div class="srm-form-group">
                    <label for="team1-logo">Logo del Equipo 1</label>
                    <div class="srm-logo-upload">
                        <input type="text" id="team1-logo" name="team1_logo"
                               placeholder="URL del logo" readonly>
                        <button type="button" class="button srm-upload-logo" data-target="team1-logo">
                            Seleccionar Logo
                        </button>
                        <div id="team1-logo-preview" class="srm-logo-preview"></div>
                    </div>
                </div>

                <h3>Equipo 2</h3>
                <div class="srm-form-row">
                    <div class="srm-form-group">
                        <label for="team2-name">Nombre Completo *</label>
                        <input type="text" id="team2-name" name="team2_name" required
                               placeholder="Ej: Boston Red Sox">
                    </div>

                    <div class="srm-form-group">
                        <label for="team2-abbr">Sigla *</label>
                        <input type="text" id="team2-abbr" name="team2_abbr" required
                               placeholder="Ej: BOS" maxlength="10">
                    </div>

                    <div class="srm-form-group">
                        <label for="team2-score">Score</label>
                        <input type="text" id="team2-score" name="team2_score"
                               placeholder="Ej: 0-0, 5">
                    </div>
                </div>

                <div class="srm-form-group">
                    <label for="team2-logo">Logo del Equipo 2</label>
                    <div class="srm-logo-upload">
                        <input type="text" id="team2-logo" name="team2_logo"
                               placeholder="URL del logo" readonly>
                        <button type="button" class="button srm-upload-logo" data-target="team2-logo">
                            Seleccionar Logo
                        </button>
                        <div id="team2-logo-preview" class="srm-logo-preview"></div>
                    </div>
                </div>

                <div class="srm-form-actions">
                    <button type="submit" class="button button-primary">Guardar Resultado</button>
                    <button type="button" class="button srm-cancel-btn">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="srm-info-box">
        <h3>Cómo usar:</h3>
        <p>Para mostrar los resultados en tu sitio, usa el shortcode:</p>
        <code>[sports_results]</code>
        <p>También puedes filtrar por deporte:</p>
        <code>[sports_results sport="MLB"]</code>
    </div>
</div>
