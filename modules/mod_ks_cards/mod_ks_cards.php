<?php

/**
 * @package     KS Cards
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$wa = $app->getDocument()->getWebAssetManager();

require ModuleHelper::getLayoutPath('mod_ks_cards', $params->get('layout', 'default'));
