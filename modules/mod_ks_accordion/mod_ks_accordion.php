<?php

/**
 * @package     KS Accordion
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa->registerAndUseStyle('bootstrap', 'media/kondasoft/bootstrap/bootstrap.min.css');
$wa->registerAndUseScript('bootstrap', 'media/kondasoft/bootstrap/bootstrap.bundle.min.js', [], ['defer' => 'defer']);

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_accordion/assets/style.css');

require ModuleHelper::getLayoutPath('mod_ks_accordion', $params->get('layout', 'default'));
