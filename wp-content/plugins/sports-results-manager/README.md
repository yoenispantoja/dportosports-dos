# Sports Results Manager

Plugin de WordPress para gestionar y visualizar resultados de eventos deportivos.

## Características

-  Gestión completa de resultados deportivos (Crear, Editar, Eliminar)
-  Soporte para múltiples deportes (MLB, La Liga, NBA, Serie Nacional Cubana, etc)
-  Carga de logos de equipos mediante biblioteca de medios de WordPress
-  Selector de deportes en el frontend
-  Carrusel responsive con navegación lateral
-  Actualización automática de eventos en vivo cada 30 segundos
-  Diseño moderno con fondo oscuro
-  Compatible con dispositivos móviles y táctiles
-  Sistema de shortcodes fácil de usar

## Instalación

1. Subir la carpeta `sports-results-manager` al directorio `/wp-content/plugins/`
2. Activar el plugin desde el menú 'Plugins' en WordPress
3. Ir a 'Resultados Deportivos' en el menú del admin para empezar a agregar resultados

## Uso del Shortcode

### Mostrar todos los resultados:
```
[sports_results]
```

### Filtrar por deporte específico:
```
[sports_results sport="MLB"]
[sports_results sport="La Liga"]
[sports_results sport="NBA"]
```

### Limitar cantidad de resultados:
```
[sports_results limit="5"]
```

## Interfaz de Administración

El plugin agrega un nuevo menú "Resultados Deportivos" en el panel de administración de WordPress donde puedes:

- Ver todos los resultados en una tabla
- Agregar nuevos resultados
- Editar resultados existentes
- Eliminar resultados
- Subir logos de equipos

### Campos del formulario:

- **Nombre del Evento**: Ej: MLB, La Liga, Eurocopa
- **Tipo de Deporte**: Clasificación del deporte
- **Fecha del Evento**: Fecha y hora del partido
- **Estado**: Programado, En Vivo, Finalizado
- **Equipo 1 y 2**:
  - Nombre completo
  - Sigla (máx 10 caracteres)
  - Logo (imagen desde biblioteca de medios)
  - Score

## Características Técnicas

- Base de datos: Tabla personalizada `wp_sports_results`
- AJAX para operaciones sin recargar página
- Capacidades de usuario: `manage_sports_results` (Editor y Administrador)
- Responsive design con breakpoints en 576px, 768px, 992px, 1200px
- Soporte para gestos táctiles (swipe)
- Auto-refresh para eventos en vivo

## Compatibilidad

- WordPress 5.0 o superior
- PHP 7.0 o superior
- Navegadores modernos (Chrome, Firefox, Safari, Edge)

## Desarrollador

DPorto Sports

## Licencia

GPL-2.0+
