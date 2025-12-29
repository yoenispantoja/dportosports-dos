# INSTRUCCIONES DE USO - Sports Results Manager

## Paso 1: Activar el Plugin

1. Ve al panel de administración de WordPress
2. Navega a **Plugins > Plugins instalados**
3. Busca "Sports Results Manager"
4. Haz clic en **Activar**

Al activar, el plugin creará automáticamente:
- Una tabla en la base de datos llamada `wp_sports_results`
- Permisos para editores y administradores
- Un nuevo menú en el panel de administración

## Paso 2: Agregar Resultados Deportivos

1. En el menú lateral, haz clic en **Resultados Deportivos**
2. Haz clic en el botón **"Agregar Nuevo Resultado"**
3. Completa el formulario:
   - **Nombre del Evento**: MLB, La Liga, NBA, etc.
   - **Tipo de Deporte**: Categoría del deporte
   - **Fecha del Evento**: Fecha y hora del partido
   - **Estado**: Programado / En Vivo / Finalizado
   
4. Para cada equipo:
   - Nombre completo del equipo
   - Sigla (ej: NYY, BOS, MAD)
   - Logo (clic en "Seleccionar Logo" para subir desde tu biblioteca de medios)
   - Score

5. Haz clic en **"Guardar Resultado"**

## Paso 3: Mostrar Resultados en tu Sitio

### Opción A: Usando el Editor de Bloques (Gutenberg)

1. Edita la página donde quieres mostrar los resultados
2. Agrega un bloque de **Shortcode**
3. Escribe: `[sports_results]`
4. Publica o actualiza la página

### Opción B: En el código del tema

Si quieres mostrar los resultados en una ubicación específica de tu tema (por ejemplo, debajo del menú), edita el archivo correspondiente del tema y agrega:

```php
<?php echo do_shortcode('[sports_results]'); ?>
```

### Opción C: Widget de texto

1. Ve a **Apariencia > Widgets**
2. Agrega un widget de "Texto" o "HTML personalizado"
3. Escribe: `[sports_results]`

## Paso 4: Personalización con Parámetros

Puedes personalizar la visualización usando parámetros:

### Filtrar por deporte:
```
[sports_results sport="MLB"]
[sports_results sport="La Liga"]
```

### Limitar cantidad de resultados:
```
[sports_results limit="8"]
```

### Combinar parámetros:
```
[sports_results sport="NBA" limit="5"]
```

## Paso 5: Posicionar Debajo del Menú (Recomendado)

Para mostrar los resultados justo debajo del menú de navegación:

### Método 1: Hook de WordPress (Recomendado)

Agrega este código en el archivo `functions.php` de tu tema:

```php
function add_sports_results_below_menu() {
    if (is_front_page() || is_home()) {
        echo do_shortcode('[sports_results]');
    }
}
add_action('wp_body_open', 'add_sports_results_below_menu');
```

### Método 2: Editar el tema directamente

1. Ve a **Apariencia > Editor de archivos del tema**
2. Busca el archivo `header.php`
3. Después de la etiqueta `</nav>` o donde termina el menú, agrega:

```php
<?php if (is_front_page() || is_home()): ?>
    <div class="sports-results-section">
        <?php echo do_shortcode('[sports_results]'); ?>
    </div>
<?php endif; ?>
```

## Gestión de Resultados

### Editar un Resultado
1. Ve a **Resultados Deportivos**
2. Haz clic en el ícono de lápiz (editar) del resultado que deseas modificar
3. Modifica los campos necesarios
4. Haz clic en **"Guardar Resultado"**

### Eliminar un Resultado
1. Ve a **Resultados Deportivos**
2. Haz clic en el ícono de papelera (eliminar) del resultado
3. Confirma la eliminación

## Características Especiales

### Eventos en Vivo
- Los resultados marcados como "En Vivo" mostrarán un badge rojo parpadeante
- Se actualizarán automáticamente cada 30 segundos

### Navegación Carousel
- Usa las flechas laterales para navegar entre resultados
- En móviles, puedes deslizar (swipe) para navegar
- El carousel es responsive y se adapta automáticamente

### Selector de Deportes
- Los visitantes pueden filtrar resultados por deporte
- El filtro se aplica instantáneamente sin recargar la página

## Solución de Problemas

### El plugin no aparece
- Verifica que esté activado en **Plugins > Plugins instalados**
- Revisa los permisos de tu rol de usuario

### No se muestran resultados en el frontend
- Verifica que hayas agregado al menos un resultado
- Asegúrate de que el shortcode esté correctamente escrito: `[sports_results]`

### Los logos no se cargan
- Verifica que las imágenes estén subidas a la biblioteca de medios
- Comprueba que las URLs de las imágenes sean accesibles

### Problemas con el carousel
- Limpia la caché del navegador
- Verifica que jQuery esté cargado correctamente
- Revisa la consola del navegador para errores JavaScript

## Soporte

Para problemas o preguntas adicionales, contacta al equipo de desarrollo de DPorto Sports.
