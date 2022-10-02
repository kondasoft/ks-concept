<?php

/**
 * @package     KS Image With Text
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

JFactory::getDocument()->addStyleSheet(JURI::root(true). '/modules/mod_ks_image_with_text/assets/style.css');

require ModuleHelper::getLayoutPath('mod_ks_image_with_text', $params->get('layout', 'default'));
