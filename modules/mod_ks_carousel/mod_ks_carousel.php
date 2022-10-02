<?php

/**
 * @package     KS Carousel
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_carousel/assets/style.css');

require ModuleHelper::getLayoutPath('mod_ks_carousel', $params->get('layout', 'default'));
