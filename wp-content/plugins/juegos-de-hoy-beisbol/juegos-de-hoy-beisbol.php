<?php
/*
Plugin Name: Juegos de Hoy - Béisbol Cubano
Description: Muestra los resultados del día desde beisbolcubano.cu en formato limpio y seguro.
Version: 1.0
Author: Yoenis
*/

function obtener_juegos_de_hoy_bc_html()
{
  $html = @file_get_contents('https://www.beisbolcubano.cu/');
  if (!$html) return '<p>No se pudo cargar la página.</p>';

  // Extraer el bloque principal
  preg_match('/<div id="MainContent_MiniDayScore_UC_UC_MDS_UpdatePanel">.*?<\/div>\s*<\/div>\s*<\/div>/s', $html, $matches);
  if (!isset($matches[0])) return '<p>No se encontró la sección de resultados del día.</p>';

  $bloque = $matches[0];

  // Extraer cada juego
  preg_match_all('/<li class="Mini_DayScore">.*?<\/li>/s', $bloque, $juegos);
  if (!isset($juegos[0]) || count($juegos[0]) === 0) return '<p>No se encontraron juegos para hoy.</p>';

  $output = '<div class="juegos-de-hoy-bc"><h4>Resultados del Día - SNB Cuba</h4><ul>';

  foreach ($juegos[0] as $juego) {
    // Estado del juego
    preg_match('/<span class="span_estado">([^<]+)<\/span>/', $juego, $estado);
    preg_match('/<span class="span_outs">([^<]+)<\/span>/', $juego, $outs);

    // Equipos
    preg_match_all('/<span class="Mini_DayScore_Siglas MDSS">([^<]+)<\/span>/', $juego, $siglas);
    preg_match_all('/<span class="Mini_DayScore_Siglas MDSN">([^<]+)<\/span>/', $juego, $nombres);

    // Carreras
    preg_match_all('/<div class="Mini_DayScore_Runs"><span>(\d+)<\/span><\/div>/', $juego, $carreras);

    if (count($siglas[1]) === 2 && count($nombres[1]) === 2 && count($carreras[1]) === 2) {
      $output .= '<li><strong>' . $estado[1] . ' - ' . $outs[1] . '</strong><br>';
      $output .= $siglas[1][0] . ' (' . $nombres[1][0] . '): ' . $carreras[1][0] . ' | ';
      $output .= $siglas[1][1] . ' (' . $nombres[1][1] . '): ' . $carreras[1][1];
      $output .= '</li>';
    }
  }

  $output .= '</ul></div>';
  return $output;
}

function mostrar_juegos_de_hoy_bc_shortcode()
{
  return obtener_juegos_de_hoy_bc_html();
}
add_shortcode('juegos_de_hoy_bc', 'mostrar_juegos_de_hoy_bc_shortcode');

function juegos_de_hoy_bc_estilos()
{
  echo '<style>
    strong{
        color: #1151D3;
    }
    .juegos-de-hoy-bc h4 {
           color: #333!important;
        }
        .juegos-de-hoy-bc {
            background: #f9f9f9;
            border: 1px solid #ccc;
            padding: 15px;
            font-family: sans-serif;
            color: #222;
        }
        .juegos-de-hoy-bc ul {
            list-style: none;
            padding-left: 0;
        }
        .juegos-de-hoy-bc li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
    </style>';
}
add_action('wp_head', 'juegos_de_hoy_bc_estilos');
