<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$template = JFactory::getApplication()->getTemplate(true);

if ($template->params->get('layout_offcanvas_show_social_menu', '1') == 1) {
    $socialMenuItems = JFactory::getApplication()->getMenu()->getItems('menutype', htmlspecialchars($template->params->get('layout_offcanvas_social_menu', 'social-media-links')));
}
?>

<div 
    id="offcanvas-menu"
    class="offcanvas offcanvas-start"
    tabindex="-1" 
    aria-labelledby="offcanvas-menu-label"
    style="width: <?php echo htmlspecialchars($template->params->get('layout_offcanvas_menu_width', '300')) ?>px">
    <div class="offcanvas-header <?php echo htmlspecialchars($template->params->get('layout_offcanvas_menu_header_bg_color', 'bg-primary text-white')) ?>">
        <h5 id="offcanvas-menu-label" class="offcanvas-title">
            <?php echo JText::_('TPL_KS_CONCEPT_LAYOUT_MENU') ?>
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
    <?php if ($template->params->get('layout_offcanvas_show_social_menu', '1') == 1) : ?>
        <div class="offcanvas-footer bg-light">
            <ul class="social-media-links nav justify-content-center py-2">
                <?php foreach ($socialMenuItems as $i => &$item) : ?>
                    <?php // var_dump($item) ?>
                    <li class="nav-item">
                        <a 
                            class="nav-link text-dark d-flex p-4" 
                            href="<?php echo $item->link ?>"
                            target="_blank"
                            aria-label="<?php echo $item->title ?>">
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                width="18" 
                                height="18"
                                class="" 
                                viewBox="0 0 24 24"
                                fill="currentColor">
                                <?php if (str_contains($item->link, 'facebook')) : ?>
                                    <path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.1 10.13 24v-8.44H7.08v-3.49h3.04V9.41c0-3.02 1.8-4.7 4.54-4.7 1.31 0 2.68.24 2.68.24v2.97h-1.5c-1.5 0-1.96.93-1.96 1.89v2.26h3.32l-.53 3.5h-2.8V24C19.62 23.1 24 18.1 24 12.07"/>
                                <?php elseif (str_contains($item->link, 'twitter')) : ?>
                                    <path d="M24 4.37a9.6 9.6 0 0 1-2.83.8 5.04 5.04 0 0 0 2.17-2.8c-.95.58-2 1-3.13 1.22A4.86 4.86 0 0 0 16.61 2a4.99 4.99 0 0 0-4.79 6.2A13.87 13.87 0 0 1 1.67 2.92 5.12 5.12 0 0 0 3.2 9.67a4.82 4.82 0 0 1-2.23-.64v.07c0 2.44 1.7 4.48 3.95 4.95a4.84 4.84 0 0 1-2.22.08c.63 2.01 2.45 3.47 4.6 3.51A9.72 9.72 0 0 1 0 19.74 13.68 13.68 0 0 0 7.55 22c9.06 0 14-7.7 14-14.37v-.65c.96-.71 1.79-1.6 2.45-2.61z"/>
                                <?php elseif (str_contains($item->link, 'instagram')) : ?>
                                    <path d="M16.98 0a6.9 6.9 0 0 1 5.08 1.98A6.94 6.94 0 0 1 24 7.02v9.96c0 2.08-.68 3.87-1.98 5.13A7.14 7.14 0 0 1 16.94 24H7.06a7.06 7.06 0 0 1-5.03-1.89A6.96 6.96 0 0 1 0 16.94V7.02C0 2.8 2.8 0 7.02 0h9.96zm.05 2.23H7.06c-1.45 0-2.7.43-3.53 1.25a4.82 4.82 0 0 0-1.3 3.54v9.92c0 1.5.43 2.7 1.3 3.58a5 5 0 0 0 3.53 1.25h9.88a5 5 0 0 0 3.53-1.25 4.73 4.73 0 0 0 1.4-3.54V7.02a5 5 0 0 0-1.3-3.49 4.82 4.82 0 0 0-3.54-1.3zM12 5.76c3.39 0 6.2 2.8 6.2 6.2a6.2 6.2 0 0 1-12.4 0 6.2 6.2 0 0 1 6.2-6.2zm0 2.22a3.99 3.99 0 0 0-3.97 3.97A3.99 3.99 0 0 0 12 15.92a3.99 3.99 0 0 0 3.97-3.97A3.99 3.99 0 0 0 12 7.98zm6.44-3.77a1.4 1.4 0 1 1 0 2.8 1.4 1.4 0 0 1 0-2.8z"/>
                                <?php elseif (str_contains($item->link, 'pinterest')) : ?>
                                    <path d="M12 0a12 12 0 0 0-4.82 23c-.03-.85 0-1.85.21-2.76l1.55-6.54s-.39-.77-.39-1.9c0-1.78 1.03-3.1 2.32-3.1 1.09 0 1.62.81 1.62 1.8 0 1.09-.7 2.73-1.06 4.25-.3 1.27.63 2.31 1.89 2.31 2.27 0 3.8-2.92 3.8-6.38 0-2.63-1.77-4.6-4.99-4.6a5.68 5.68 0 0 0-5.9 5.75c0 1.05.3 1.78.78 2.35.23.27.26.37.18.67l-.25.97c-.08.3-.32.4-.6.3-1.67-.69-2.46-2.52-2.46-4.59 0-3.4 2.88-7.5 8.58-7.5 4.58 0 7.6 3.32 7.6 6.88 0 4.7-2.62 8.22-6.48 8.22-1.3 0-2.51-.7-2.93-1.5l-.84 3.3c-.26.93-.76 1.86-1.21 2.58A11.99 11.99 0 0 0 24 12 12 12 0 0 0 12 0z"/>
                                <?php elseif (str_contains($item->link, 'youtube')) : ?>
                                    <path d="M12.04 3.5c.59 0 7.54.02 9.34.5a3.02 3.02 0 0 1 2.12 2.15C24 8.05 24 12 24 12v.04c0 .43-.03 4.03-.5 5.8A3.02 3.02 0 0 1 21.38 20c-1.76.48-8.45.5-9.3.51h-.17c-.85 0-7.54-.03-9.29-.5A3.02 3.02 0 0 1 .5 17.84c-.42-1.61-.49-4.7-.5-5.6v-.5c.01-.9.08-3.99.5-5.6a3.02 3.02 0 0 1 2.12-2.14c1.8-.49 8.75-.51 9.34-.51zM9.54 8.4v7.18L15.82 12 9.54 8.41z"/>
                                <?php elseif (str_contains($item->link, 'linkedin')) : ?>
                                    <path d="M22.23 0H1.77C.8 0 0 .77 0 1.72v20.56C0 23.23.8 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.2 0 22.23 0zM7.27 20.1H3.65V9.24h3.62V20.1zM5.47 7.76h-.03c-1.22 0-2-.83-2-1.87 0-1.06.8-1.87 2.05-1.87 1.24 0 2 .8 2.02 1.87 0 1.04-.78 1.87-2.05 1.87zM20.34 20.1h-3.63v-5.8c0-1.45-.52-2.45-1.83-2.45-1 0-1.6.67-1.87 1.32-.1.23-.11.55-.11.88v6.05H9.28s.05-9.82 0-10.84h3.63v1.54a3.6 3.6 0 0 1 3.26-1.8c2.39 0 4.18 1.56 4.18 4.89v6.21z"/>
                                <?php elseif (str_contains($item->link, 'tiktok')) : ?>
                                    <path d="M22.5 9.84202C20.4357 9.84696 18.4221 9.20321 16.7435 8.00171V16.3813C16.7429 17.9333 16.2685 19.4482 15.3838 20.7233C14.499 21.9984 13.246 22.973 11.7923 23.5168C10.3387 24.0606 8.75362 24.1477 7.24914 23.7664C5.74466 23.3851 4.39245 22.5536 3.37333 21.383C2.3542 20.2125 1.71674 18.7587 1.54617 17.2161C1.3756 15.6735 1.68007 14.1156 2.41884 12.7507C3.15762 11.3858 4.2955 10.279 5.68034 9.57823C7.06517 8.87746 8.63095 8.61616 10.1683 8.82927V13.0439C9.4648 12.8227 8.70938 12.8293 8.0099 13.063C7.31041 13.2966 6.70265 13.7453 6.2734 14.345C5.84415 14.9446 5.61536 15.6646 5.6197 16.402C5.62404 17.1395 5.8613 17.8567 6.29759 18.4512C6.73387 19.0458 7.34688 19.4873 8.04906 19.7127C8.75125 19.9381 9.5067 19.9359 10.2075 19.7063C10.9084 19.4768 11.5188 19.0316 11.9515 18.4345C12.3843 17.8374 12.6173 17.1188 12.6173 16.3813V0H16.7435C16.7406 0.348435 16.7698 0.696395 16.8307 1.03948V1.03948C16.9741 1.80537 17.2722 2.53396 17.7068 3.18068C18.1415 3.8274 18.7035 4.37867 19.3585 4.80075C20.2903 5.41688 21.3829 5.74528 22.5 5.74505V9.84202Z"/>
                                <?php elseif (str_contains($item->link, 'whatsapp')) : ?>
                                    <path d="M24 11.7c0 6.45-5.27 11.68-11.78 11.68-2.07 0-4-.53-5.7-1.45L0 24l2.13-6.27a11.57 11.57 0 0 1-1.7-6.04C.44 5.23 5.72 0 12.23 0 18.72 0 24 5.23 24 11.7M12.22 1.85c-5.46 0-9.9 4.41-9.9 9.83 0 2.15.7 4.14 1.88 5.76L2.96 21.1l3.8-1.2a9.9 9.9 0 0 0 5.46 1.62c5.46 0 9.9-4.4 9.9-9.83a9.88 9.88 0 0 0-9.9-9.83m5.95 12.52c-.08-.12-.27-.19-.56-.33-.28-.14-1.7-.84-1.97-.93-.26-.1-.46-.15-.65.14-.2.29-.75.93-.91 1.12-.17.2-.34.22-.63.08-.29-.15-1.22-.45-2.32-1.43a8.64 8.64 0 0 1-1.6-1.98c-.18-.29-.03-.44.12-.58.13-.13.29-.34.43-.5.15-.17.2-.3.29-.48.1-.2.05-.36-.02-.5-.08-.15-.65-1.56-.9-2.13-.24-.58-.48-.48-.64-.48-.17 0-.37-.03-.56-.03-.2 0-.5.08-.77.36-.26.29-1 .98-1 2.4 0 1.4 1.03 2.76 1.17 2.96.14.19 2 3.17 4.93 4.32 2.94 1.15 2.94.77 3.47.72.53-.05 1.7-.7 1.95-1.36.24-.67.24-1.25.17-1.37"/>
                                <?php endif ?>
                            </svg>
                        </a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>
</div>