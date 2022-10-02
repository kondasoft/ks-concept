<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

function hexToRGB($hex) {
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    return $r . ', ' .$g . ', ' . $b;
}

function colourBrightness($hex, $percent) {
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
    for ($i = 0; $i < 3; $i++) {
        if ($percent > 0) {
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * (1 - $positivePercent)); // round($rgb[$i] * (1-$positivePercent));
        }
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        $hexDigit = dechex($rgb[$i]);
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}

$primaryColor = htmlspecialchars($this->params->get('color_primary', '#D32F2F'));
$secondaryColor = htmlspecialchars($this->params->get('color_secondary', '#455A64'));
$lightColor = htmlspecialchars($this->params->get('color_light', '#F5F5F5'));
$darkColor = htmlspecialchars($this->params->get('color_dark', '#212121'));

$headingsFontFamily = htmlspecialchars($this->params->get('general_typography_headings_font_family', 'Roboto'));
$headingsFontWeight = htmlspecialchars($this->params->get('general_typography_headings_font_weight', '500'));
if (htmlspecialchars($this->params->get('general_typography_body_font_option', 'system-fonts') === 'google-fonts')) {
    $bodyFontFamily = '"' . htmlspecialchars($this->params->get('general_typography_body_font_family', 'Open Sans')) . '"';
} else {
    $bodyFontFamily = 'var(--bs-font-sans-serif)';
}

$wa->addInlineStyle('
    :root {
        --bs-primary: ' . $primaryColor . ';
        --bs-primary-rgb: ' . hexToRGB($primaryColor) . ';
        --bs-primary-lighten-10: ' . colourBrightness($primaryColor, 0.9) . ';
        --bs-primary-darken-10: ' . colourBrightness($primaryColor, -0.1) . ';
        --bs-primary-darken-20: ' . colourBrightness($primaryColor, -0.2) . ';
        --bs-secondary: ' . $secondaryColor . ';
        --bs-secondary-rgb: ' . hexToRGB($secondaryColor) . ';
        --bs-secondary-lighten-10: ' . colourBrightness($secondaryColor, 0.9) . ';
        --bs-secondary-darken-10: ' . colourBrightness($secondaryColor, -0.1) . ';
        --bs-secondary-darken-20: ' . colourBrightness($secondaryColor, -0.2) . ';
        --bs-light: ' . $lightColor . ';
        --bs-light-rgb: ' . hexToRGB($lightColor) . ';
        --bs-light-lighten-10: ' . colourBrightness($lightColor, 0.9) . ';
        --bs-light-darken-10: ' . colourBrightness($lightColor, -0.1) . ';
        --bs-light-darken-10: ' . colourBrightness($lightColor, -0.2) . ';
        --bs-dark: ' . $darkColor . ';
        --bs-dark-rgb: ' . hexToRGB($darkColor) . ';
        --bs-dark-lighten-10: ' . colourBrightness($darkColor, 0.9) . ';
        --bs-dark-darken-10: ' . colourBrightness($darkColor, -0.1) . ';
        --bs-dark-darken-20: ' . colourBrightness($darkColor, -0.2) . ';

        --bs-headings-font-family: "' .$headingsFontFamily . '", sans-serif;
        --bs-headings-font-weight: ' .$headingsFontWeight . ';
        --bs-body-font-family: ' . $bodyFontFamily . ';
    }
', ['position' => 'after'], [], ['bootstrap']);