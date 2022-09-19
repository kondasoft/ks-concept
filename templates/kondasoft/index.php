<?php

/**
 * @package     KondaSoft
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$wa  = $this->getWebAssetManager();

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
$this->addHeadLink(HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);

// Detecting Active Variables
$option     = $app->input->getCmd('option', '');
$view       = $app->input->getCmd('view', '');
$layout     = $app->input->getCmd('layout', '');
$task       = $app->input->getCmd('task', '');
$itemid     = $app->input->getCmd('Itemid', '');
$sitename   = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$menu       = $app->getMenu()->getActive();
$pageclass  = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';
$media_path     = 'media/templates/site/' . $app->getTemplate();
$template_path  = 'templates/' . $app->getTemplate();


// Vendor Stylesheets/Javascript
$wa->registerAndUseStyle('bootstrap', $media_path . '/css/vendor/bootstrap.min.css');
$wa->registerAndUseStyle('animate.css', $media_path . '/css/vendor/animate.min.css');
$wa->registerAndUseScript('bootstrap', $media_path . '/js/vendor/bootstrap.bundle.min.js', [], ['defer' => 'defer']);

// Template CSS variables
require_once($media_path . '/css/variables.php');

// Template Stylesheets
HTMLHelper::stylesheet($media_path . '/css/base.css');
HTMLHelper::stylesheet($media_path . '/css/layout.css');

// Template Javascript
HTMLHelper::script($media_path . '/js/base.js', [], ['defer' => 'defer']);
HTMLHelper::script($media_path . '/js/smart-search.js', [], ['defer' => 'defer']);
HTMLHelper::script($media_path . '/js/layout.js', [], ['defer' => 'defer']);

// Google Fonts
$headingsFontFamily = htmlspecialchars(preg_replace('/\s+/', '+' , $this->params->get('general_typography_headings_font_family', 'Roboto')));
$headingsFontWeight = htmlspecialchars($this->params->get('general_typography_headings_font_weight', '500'));
if ($this->params->get('general_typography_body_font_option', 'system-fonts') === 'google-fonts') {
    $bodyFontFamily = htmlspecialchars(preg_replace('/\s+/', '+' , $this->params->get('general_typography_body_font_family', 'Open Sans')));
    $googleFonts = '?family=' . $headingsFontFamily . ':wght@' . $headingsFontWeight . '&family=' . $bodyFontFamily . ':ital,wght@0,400;0,500;0,700;1,400';
} else {
    $googleFonts = '?family=' . $headingsFontFamily . ':wght@' . $headingsFontWeight;
}
HTMLHelper::stylesheet('https://fonts.googleapis.com/css2' . $googleFonts . '&display=swap');

// Other
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->getPreloadManager()->preconnect('https://fonts.googleapis.com/', []);
$this->getPreloadManager()->preconnect('https://fonts.gstatic.com/', []);
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
            <?php echo htmlspecialchars($this->params->get('layout_navbar_bg_color', 'bg-white')) ?> 
            <?php echo htmlspecialchars($this->params->get('layout_navbar_shadow', 'shadow-sm')) ?> 
            <?php echo 'py-' . htmlspecialchars($this->params->get('layout_navbar_spacing', '3')) ?>
        ">
        <div class="<?php echo $this->params->get('layout_navbar_container', 'container') ?> d-block">
            <div id="site-navbar-row-mobile" class="row align-items-center d-xl-none">
                <div class="col-3">
                    <a 
                        class="nav-link d-inline-block p-2"
                        data-bs-toggle="offcanvas" 
                        href="#offcanvas-menu" 
                        aria-controls="offcanvas-menu" 
                        aria-expanded="false" 
                        aria-label="<?php echo JText::_('TPL_KONDASOFT_ACCESSIBILITY_TOGGLE_NAV') ?>"
                        role="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </div>
                <div class="col-6">
                    <div class="text-center">
                        <?php require($template_path . '/includes/navbar-logo.php'); ?>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-end">
                        <?php if ($this->params->get('layout_navbar_right_content', 'smart-search') === 'smart-search') : ?>
                            <a 
                                class="nav-link d-inline-block p-2"
                                data-bs-toggle="collapse" 
                                href="#offcanvas-search" 
                                aria-controls="offcanvas-search" 
                                aria-expanded="false" 
                                aria-label="<?php echo JText::_('TPL_KONDASOFT_SMART_SEARCH_INPUT_LABEL') ?>"
                                role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </a>
                        <?php elseif ($this->params->get('layout_navbar_right_content', 'smart-search') === 'cta-button') : ?>
                            <?php require_once($template_path . '/includes/cta-button.php'); ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div id="site-navbar-row-desktop" class="row align-items-center d-none d-xl-flex">
                <div class="col-3">
                    <?php require($template_path . '/includes/navbar-logo.php'); ?>
                </div>
                <div class="col-6">
                    <div class="collapse navbar-collapse justify-content-center">
                        <jdoc:include type="modules" name="mainmenu-desktop" style="none" />
                    </div>
                </div>
                <div class="col-3">
                    <?php if ($this->params->get('layout_navbar_right_content', 'smart-search') === 'smart-search') : ?>
                        <?php require_once($template_path . '/includes/smart-search.php'); ?>
                    <?php elseif ($this->params->get('layout_navbar_right_content', 'smart-search') === 'cta-button') : ?>
                        <?php require_once($template_path . '/includes/cta-button.php'); ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>

    <?php if ($this->countModules('carousel', true)) : ?>
        <section id="site-carousel">
            <jdoc:include type="modules" name="carousel" style="none" />
        </section>
    <?php endif; ?>


    <jdoc:include type="modules" name="breadcrumbs" style="none" />

    <jdoc:include type="message" />

    <main id="site-main" role="main">
        <jdoc:include type="component" />
    </main>
    
    <?php if ($this->countModules('footer', true)) : ?>
        <footer class="container-footer footer full-width">
            <div class="grid-child">
                <jdoc:include type="modules" name="footer" style="none" />
            </div>
        </footer>
    <?php endif; ?>

    <?php require_once($template_path . '/includes/offcanvas-menu.php'); ?>

    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
