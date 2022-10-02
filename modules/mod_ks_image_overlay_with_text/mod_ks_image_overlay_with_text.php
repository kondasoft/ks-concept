<?php

/**
 * @package     KS Image Overlay With Text
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();

$wa->registerAndUseScript('simpleParallax','/media/kondasoft/simple-parallax/simpleParallax.min.js', [], ['defer' => 'defer']);

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_image_overlay_with_text/assets/style.css');
JFactory::getDocument()->addScript(JURI::root(true). '/modules/mod_ks_image_overlay_with_text/assets/script.js',  [], ['defer' => 'defer']);

require ModuleHelper::getLayoutPath('mod_ks_image_overlay_with_text', $params->get('layout', 'default'));
