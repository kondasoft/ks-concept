<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Favicon
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);

// Detecting Active Variables
$option     = $app->input->getCmd('option', '');
$view       = $app->input->getCmd('view', '');
$layout     = $app->input->getCmd('layout', '');
$task       = $app->input->getCmd('task', '');
$itemid     = $app->input->getCmd('Itemid', '');
$sitename   = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu       = $app->getMenu()->getActive();
$lang       = $app->getLanguage();
$pageclass  = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$template_path  = 'templates/' . $app->getTemplate();

// Vendor Stylesheets
$wa->registerAndUseStyle('bootstrap', 'media/kondasoft/bootstrap/bootstrap.min.css');
$wa->registerAndUseStyle('animate-css', 'media/kondasoft/animate/animate.min.css');

// Vendor JavaScript
$wa->registerAndUseScript('bootstrap', 'media/kondasoft/bootstrap/bootstrap.bundle.min.js', [], ['defer' => 'defer']);
$wa->registerAndUseScript('enter-view', 'media/kondasoft/enter-view/enter-view.min.js', [], ['defer' => 'defer']);

// Template CSS variables
require_once($template_path . '/assets/css/variables.php');

// Template Stylesheets
HTMLHelper::stylesheet($template_path . '/assets/css/base.css');
HTMLHelper::stylesheet($template_path . '/assets/css/layout.css');
HTMLHelper::stylesheet($template_path . '/assets/css/joomla.css');
HTMLHelper::stylesheet($template_path . '/assets/css/custom.css');

// Template Javascript
HTMLHelper::script($template_path . '/assets/js/base.js', [], ['defer' => 'defer']);
HTMLHelper::script($template_path . '/assets/js/smart-search.js', [], ['defer' => 'defer']);
HTMLHelper::script($template_path . '/assets/js/general.js', [], ['defer' => 'defer']);
HTMLHelper::script($template_path . '/assets/js/custom.js', [], ['defer' => 'defer']);

// Pre-connect (Google fonts)
HTMLHelper::stylesheet('https://fonts.googleapis.com/', [], ['rel' => 'preconnect']);
HTMLHelper::stylesheet('https://fonts.gstatic.com', [], ['rel' => 'preconnect', 'crossorigin' => 'anonymous']);

// Google Fonts
$headingsFontFamily = htmlspecialchars(preg_replace('/\s+/', '+' , $this->params->get('general_typography_headings_font_family', 'Roboto')));
$headingsFontWeight = htmlspecialchars($this->params->get('general_typography_headings_font_weight', '500'));

if ($this->params->get('general_typography_body_font_option') === 'google-fonts') {
    $bodyFontFamily = htmlspecialchars(preg_replace('/\s+/', '+' , $this->params->get('general_typography_body_font_family', 'Open Sans')));
    $googleFonts = '?family=' . $headingsFontFamily . ':wght@' . $headingsFontWeight . '&family=' . $bodyFontFamily . ':ital,wght@0,400;0,500;0,700;1,400';
} else {
    $googleFonts = '?family=' . $headingsFontFamily . ':wght@' . $headingsFontWeight;
}

HTMLHelper::stylesheet('https://fonts.googleapis.com/css2' . $googleFonts . '&display=swap');

// Other
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->getPreloadManager()->preconnect('https://fonts.googleapis.com/', []);
$this->getPreloadManager()->preconnect('https://fonts.gstatic.com/', []);
