<?php

/**
 * @package     KondaSoft
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$template = JFactory::getApplication()->getTemplate(true);
?>

<div 
    id="offcanvas-menu"
    class="offcanvas offcanvas-start"
    tabindex="-1" 
    aria-labelledby="offcanvas-menu-label"
    style="width: <?php echo htmlspecialchars($template->params->get('layout_offcanvas_menu_width', '300')) ?>px">
    <div class="offcanvas-header <?php echo htmlspecialchars($template->params->get('layout_offcanvas_menu_header_bg_color', 'bg-primary text-white')) ?>">
        <h5 id="offcanvas-menu-label" class="offcanvas-title">
            <?php echo JText::_('TPL_KONDASOFT_LAYOUT_MENU') ?>
        </h5>
        <button 
            type="button" 
            class="btn-close <?php if (str_contains($template->params->get('layout_offcanvas_menu_header_bg_color', 'bg-primary text-white'), 'text-white')) : ?>btn-close-white<?php endif ?>" 
            data-bs-dismiss="offcanvas" 
            aria-label="Close">
        </button>
    </div>
    <div class="offcanvas-body px-0">
        <jdoc:include type="modules" name="mainmenu-mobile" style="mainmenu-mobile" />
    </div>
</div>