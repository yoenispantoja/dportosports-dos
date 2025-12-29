-- Datos de ejemplo para Sports Results Manager
-- Ejecutar después de activar el plugin
-- IMPORTANTE: Asegúrate de que la tabla existe antes de ejecutar

-- Resultados de MLB
INSERT INTO wp_87f6af6a9e_sports_results (event_name, event_date, sport_type, team1_name, team1_abbr, team1_score, team2_name, team2_abbr, team2_score, status, display_order) VALUES
('MLB', '2025-12-21 19:00:00', 'MLB', 'New York Yankees', 'NYY', '0-0', 'Baltimore Orioles', 'BAL', '0-0', 'scheduled', 1),
('MLB', '2025-12-21 19:00:00', 'MLB', 'Chicago White Sox', 'CHW', '0-0', 'Chicago Cubs', 'CHC', '0-0', 'scheduled', 2),
('MLB', '2025-12-21 20:00:00', 'MLB', 'Colorado Rockies', 'COL', '0-0', 'Arizona Diamondbacks', 'ARI', '0-0', 'scheduled', 3),
('MLB', '2025-12-21 21:00:00', 'MLB', 'Seattle Mariners', 'SEA', '0-0', 'San Diego Padres', 'SD', '0-0', 'scheduled', 4);

-- Resultados de La Liga
INSERT INTO wp_87f6af6a9e_sports_results (event_name, event_date, sport_type, team1_name, team1_abbr, team1_score, team2_name, team2_abbr, team2_score, status, display_order) VALUES
('La Liga', '2025-12-21 15:00:00', 'La Liga', 'Real Madrid', 'MAD', '1', 'Sevilla FC', 'SEV', '0', 'finished', 1),
('La Liga', '2025-12-21 17:30:00', 'La Liga', 'Real Oviedo', 'OVI', '0', 'Celta de Vigo', 'VIG', '0', 'live', 2),
('La Liga', '2025-12-21 20:00:00', 'La Liga', 'Levante UD', 'LEV', '1', 'Real Sociedad', 'SOC', '1', 'finished', 3),
('La Liga', '2025-12-21 21:00:00', 'La Liga', 'CA Osasuna', 'OSA', '3', 'Deportivo Alavés', 'ALA', '0', 'finished', 4);

-- Resultados de Serie Nacional (Béisbol Cubano)
INSERT INTO wp_87f6af6a9e_sports_results (event_name, event_date, sport_type, team1_name, team1_abbr, team1_score, team2_name, team2_abbr, team2_score, status, display_order) VALUES
('Serie Nacional', '2025-12-21 19:30:00', 'SNB', 'Industriales', 'IND', '5', 'Santiago de Cuba', 'STG', '3', 'finished', 1),
('Serie Nacional', '2025-12-21 19:30:00', 'SNB', 'Pinar del Río', 'PIN', '2', 'Las Tunas', 'TUN', '1', 'finished', 2);

-- Resultados de NBA
INSERT INTO wp_87f6af6a9e_sports_results (event_name, event_date, sport_type, team1_name, team1_abbr, team1_score, team2_name, team2_abbr, team2_score, status, display_order) VALUES
('NBA', '2025-12-21 19:00:00', 'NBA', 'Los Angeles Lakers', 'LAL', '102', 'Boston Celtics', 'BOS', '98', 'live', 1),
('NBA', '2025-12-21 20:00:00', 'NBA', 'Miami Heat', 'MIA', '0', 'Golden State Warriors', 'GSW', '0', 'scheduled', 2);
