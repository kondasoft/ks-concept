<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/** @var Joomla\CMS\Document\HtmlDocument $this */

require_once('templates/' . Factory::getApplication()->getTemplate() . '/includes/head.php');
?>

<!DOCTYPE html>
<html 
    lang="<?php echo $this->language; ?>" 
    dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body 
    class="
        <?php echo $option ?>
        <?php echo 'view-' . $view ?>
        <?php echo $layout ? ' layout-' . $layout : ' no-layout' ?>
        <?php echo $task ? ' task-' . $task : ' no-task' ?>
        <?php echo $itemid ? ' itemid-' . $itemid : '' ?>
        <?php echo $pageclass ? ' ' . $pageclass : '' ?>
    ">
    
    <!-- Skip to content (accessibility) -->
    <a class="visually-hidden-focusable" href="#site-main">
        <?php echo JText::_('TPL_KS_CONCEPT_ACCESSIBILITY_SKIP_TO_CONTENT') ?>
    </a>

    <!-- Topbar -->
    <?php if ($this->countModules('topbar')) : ?>
        <section 
            id="site-topbar" 
            class="
                text-center lh-sm
                <?php echo htmlspecialchars($this->params->get('layout_topbar_bg_color', 'bg-dark text-white')) ?> 
                <?php echo 'py-' . htmlspecialchars($this->params->get('layout_topbar_spacing', '3')) ?>
            ">
            <div class="container">
                <div class="animate__animated animate__faster animate__fadeInDown">
                    <jdoc:include type="modules" name="topbar" style="none" />
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Navbar -->
    <nav 
        id="site-navbar"
        class="
            navbar navbar-expand sticky-top
            <?php echo htmlspecialchars($this->params->get('layout_navbar_bg_color', 'bg-white navbar-light')) ?> 
            <?php echo htmlspecialchars($this->params->get('layout_navbar_shadow', 'shadow-sm')) ?> 
            <?php echo 'py-' . htmlspecialchars($this->params->get('layout_navbar_spacing', '3')) ?>
        ">
        <div class="<?php echo $this->params->get('layout_navbar_container', 'container') ?> d-block">
            <div id="site-navbar-row-mobile" class="row align-items-center d-xl-none">
                <div class="col-3">
                    <a 
                        class="nav-link d-inline-block px-3 py-2"
                        data-bs-toggle="offcanvas" 
                        href="#offcanvas-menu" 
                        aria-controls="offcanvas-menu" 
                        aria-expanded="false" 
                        aria-label="<?php echo JText::_('TPL_KS_CONCEPT_ACCESSIBILITY_TOGGLE_NAV') ?>"
                        role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </div>
                <div class="col-6">
                    <div class="text-center">
                        <?php require('templates/' . Factory::getApplication()->getTemplate() . '/includes/navbar-logo.php'); ?>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <?php if ($this->params->get('layout_navbar_right_content', 'smart-search') === 'smart-search') : ?>
                            <a 
                                class="smart-search-icon-link nav-link d-inline-flex px-3 py-2"
                                data-bs-toggle="collapse" 
                                href="#smart-search-form-collapse-mobile" 
                                aria-expanded="false" 
                                aria-controls="smart-search-form-collapse-mobile"
                                aria-label="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_INPUT_LABEL') ?>"
                                role="button">
                                <span class="icon-search"></span>
                                <span class="icon-close" hidden></span>
                            </a>
                        <?php elseif ($this->params->get('layout_navbar_right_content', 'smart-search') === 'cta-button') : ?>
                            <a
                                class="cta-button nav-link d-inline-flex px-3 py-2"
                                href="<?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_url', '#')) ?>"
                                aria-label="<?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_text', 'Contact us')) ?>">
                                <span class="<?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_icon', 'icon-mail')) ?>"></span>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php if ($this->params->get('layout_navbar_right_content', 'smart-search') === 'smart-search') : ?>
                <div id="smart-search-form-collapse-mobile" class="collapse">
                    <?php require('templates/' . Factory::getApplication()->getTemplate() . '/includes/smart-search.php'); ?>
                </div>
            <?php endif ?>
            <div id="site-navbar-row-desktop" class="row align-items-center d-none d-xl-flex">
                <div class="col-3">
                    <?php require('templates/' . Factory::getApplication()->getTemplate() . '/includes/navbar-logo.php'); ?>
                </div>
                <div class="col-6">
                    <div class="collapse navbar-collapse justify-content-center">
                        <jdoc:include type="modules" name="mainmenu-desktop" style="none" />
                    </div>
                </div>
                <div class="col-3">
                    <?php if ($this->params->get('layout_navbar_right_content', 'smart-search') === 'smart-search') : ?>
                        <?php require('templates/' . Factory::getApplication()->getTemplate() . '/includes/smart-search.php'); ?>
                    <?php elseif ($this->params->get('layout_navbar_right_content', 'smart-search') === 'cta-button') : ?>
                        <a
                            class="cta-button btn d-inline-flex align-items-center <?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_color', 'btn-primary')) ?>"
                            href="<?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_url', '#')) ?>">
                            <span class="<?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_icon', 'icon-mail')) ?> me-3"></span>
                            <?php echo htmlspecialchars($this->params->get('layout_navbar_cta_button_text', 'Contact us')) ?>
                        </a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

    <main id="site-main" role="main">
        <jdoc:include type="modules" name="main-top" style="none" />

        <?php 
            $is_homepage = $menu == Factory::getApplication()->getMenu()->getDefault($lang->getTag());
            $hide_homepage_content = $is_homepage && $this->params->get('layout_general_hide_homepage_component', 1);
        ?>

        <div class="container <?php if (!$hide_homepage_content) : ?>py-10<?php endif ?>">
            <jdoc:include type="message" />
            <?php if (!$hide_homepage_content) : ?>
                <jdoc:include type="component" />
            <?php endif ?>
        </div>

        <jdoc:include type="modules" name="main-bottom" style="none" />
    </main>
    
    <footer 
        id="site-footer"
        class="
            <?php echo htmlspecialchars($this->params->get('layout_footer_bg_color', 'bg-dark text-white')) ?> 
            <?php echo 'pt-' . htmlspecialchars($this->params->get('layout_footer_spacing_top', '10')) ?>
        ">
        <div class="container">
            <div class="row">
                <jdoc:include type="modules" name="footer" style="footer" />
            </div>
            <hr>
            <div id="site-copyright">
                <p>
                    &copy; <?php echo date("Y"); ?> <?php echo $sitename; ?>. <?php echo JText::_('TPL_KS_CONCEPT_ALL_RIGHTS_RESERVED') ?>
                </p>
                <p class="opacity-50">
                    <?php echo JText::_('TPL_KS_CONCEPT_FOOTER_CREDITS') ?>
                </p>
            </div>
        </div>
    </footer>

    <?php require_once('templates/' . Factory::getApplication()->getTemplate() . '/includes/offcanvas-menu.php'); ?>

    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
