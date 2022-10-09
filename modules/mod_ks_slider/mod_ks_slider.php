<?php

/**
 * @package     KS Slider
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseStyle('splide', 'media/kondasoft/splide/splide.min.css');
$wa->registerAndUseScript('splide', 'media/kondasoft/splide/splide.min.js', [], ['defer' => 'defer']);

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_slider/assets/style.css');
JFactory::getDocument()->addScript(JURI::root(true). '/modules/mod_ks_slider/assets/script.js',  [], ['defer' => 'defer']);

require ModuleHelper::getLayoutPath('mod_ks_slider', $params->get('layout', 'default'));
