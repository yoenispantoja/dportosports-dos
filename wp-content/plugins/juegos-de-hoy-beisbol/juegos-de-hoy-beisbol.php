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
  if (!isset($matches[0])) return '<p>No pudimos sincronizar los resultados de la SNB.</p>';

  $bloque = $matches[0];

  // Extraer cada juego
  preg_match_all('/<li class="Mini_DayScore">.*?<\/li>/s', $bloque, $juegos);
  if (!isset($juegos[0]) || count($juegos[0]) === 0) return '<p>No se encontraron juegos para hoy.</p>';

  $output = '<div id="jdh-wrap" style="width:100%;max-width:420px;"><style>@font-face{font-family:proxima-nova;src:url(/wp-content/fonts/proxima-nova.otf) format("opentype");font-display:swap;} #jdh-wrap{font-family:proxima-nova,Arial,sans-serif;width:100%;max-width:420px;} .jdh-title{text-align:center;font-weight:700;font-size:1em;margin-bottom:0.7em;color:#e5e8f0;letter-spacing:1px;line-height:1.1;} .jdh-game{background:#fff;border-radius:12px;padding:10px 6px;margin-bottom:12px;box-shadow:0 2px 8px rgba(0,0,0,0.07);display:flex;align-items:center;justify-content:space-between;} .jdh-team{flex:1;text-align:center;} .jdh-logo{width:36px;height:36px;object-fit:contain;margin-bottom:4px;} .jdh-sigla{font-size:0.95em;font-weight:600;color:#222;} .jdh-hora{font-size:0.85em;font-weight:600;color:#1151D3;margin-bottom:2px;} .jdh-score{font-size:1.35em;font-weight:700;letter-spacing:1px;line-height:1.1;color:#222;} .jdh-estado{font-size:0.85em;color:#888;margin-top:2px;}</style>';
  $output .= '<div class="jdh-title">Resultados del Día - SNB Cuba</div>';
  $hay_juegos = false;
  foreach ($juegos[0] as $juego) {
    preg_match('/<span class="span_estado">([^<]+)<\/span>/', $juego, $estado);
    preg_match('/<span class="span_outs">([^<]+)<\/span>/', $juego, $outs);
    preg_match_all('/<span class="Mini_DayScore_Siglas MDSS">([^<]+)<\/span>/', $juego, $siglas);
    preg_match_all('/<span class="Mini_DayScore_Siglas MDSN">([^<]+)<\/span>/', $juego, $nombres);
    preg_match_all('/<div class="Mini_DayScore_Runs"><span>(\d+)<\/span><\/div>/', $juego, $carreras);

    if (count($siglas[1]) === 2 && count($nombres[1]) === 2) {
      $hay_juegos = true;
      $estado_val = isset($estado[1]) ? $estado[1] : '';
      $hora = preg_match('/^\d{1,2}:\d{2}$/', $estado_val) ? $estado_val : '';
      $score1 = isset($carreras[1][0]) ? $carreras[1][0] : '0';
      $score2 = isset($carreras[1][1]) ? $carreras[1][1] : '0';
      $logo1 = '/wp-content/uploads/logos_SNB/' . strtoupper($siglas[1][0]) . '.png';
      $logo2 = '/wp-content/uploads/logos_SNB/' . strtoupper($siglas[1][1]) . '.png';

  $output .= '<div class="jdh-game">';
  $output .= '<div class="jdh-team"><img class="jdh-logo" src="' . $logo1 . '" alt="' . $siglas[1][0] . '"><br><span class="jdh-sigla">' . $siglas[1][0] . '</span></div>';
  $output .= '<div class="jdh-team">';
  $output .= '<div class="jdh-hora">' . ($hora ? $hora : '') . '</div>';
  $output .= '<div class="jdh-score">' . $score1 . ' - ' . $score2 . '</div>';
  $output .= '<div class="jdh-estado">' . ($estado_val && !$hora ? $estado_val : '') . '</div>';
  $output .= '</div>';
  $output .= '<div class="jdh-team"><img class="jdh-logo" src="' . $logo2 . '" alt="' . $siglas[1][1] . '"><br><span class="jdh-sigla">' . $siglas[1][1] . '</span></div>';
  $output .= '</div>';
    }
  }
  if (!$hay_juegos) {
    $output .= '<div style="text-align:center;padding:2em 0;color:#888;font-size:1.1em;">No hay juegos disponibles para hoy.</div>';
  }
  $output .= '</div>';
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
    .juegos-de-hoy-bc h5 {
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
            font-size: 12px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
    </style>';
}
add_action('wp_head', 'juegos_de_hoy_bc_estilos');
