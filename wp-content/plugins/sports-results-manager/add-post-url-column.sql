-- Script para agregar la columna post_url a la tabla existente
-- Ejecutar esto en phpMyAdmin si el plugin ya estaba activado

USE db_dom819781;

-- Agregar columna post_url si no existe
ALTER TABLE `wp_87f6af6a9e_sports_results` 
ADD COLUMN IF NOT EXISTS `post_url` varchar(500) DEFAULT '' AFTER `status`;

-- Verificar que la columna se agregó correctamente
DESCRIBE `wp_87f6af6a9e_sports_results`;
