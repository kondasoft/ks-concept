<?php

/**
 * @package     KS Animated Counters
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_animated_counters/assets/style.css');
JFactory::getDocument()->addScript(JURI::root(true). '/modules/mod_ks_animated_counters/assets/script.js',  [], ['defer' => 'defer']);

require ModuleHelper::getLayoutPath('mod_ks_animated_counters', $params->get('layout', 'default'));
