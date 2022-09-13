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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

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

// Vendor Stylesheets
$wa->registerAndUseStyle('bootstrap', 'media/templates/site/kondasoft/css/vendor/bootstrap.min.css');
$wa->registerAndUseStyle('animate.css', 'media/templates/site/kondasoft/css/vendor/animate.min.css');

// Template Stylesheets
HTMLHelper::stylesheet('media/templates/site/kondasoft/css/base.css');
HTMLHelper::stylesheet('media/templates/site/kondasoft/css/layout.css');

// Javascript
$wa->registerAndUseScript('bootstrap', 'media/templates/site/kondasoft/js/vendor/bootstrap.bundle.min.js', [], ['defer' => 'defer']);
HTMLHelper::script('media/templates/site/kondasoft/js/base.js', [], ['defer' => 'defer']);
HTMLHelper::script('media/templates/site/kondasoft/js/layout.js', [], ['defer' => 'defer']);

// Other
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

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
                text-center
                <?php echo $this->params->get('positions_topbar_bg_color', 'bg-primary text-white') ?> 
                <?php echo 'py-' . $this->params->get('positions_topbar_spacing', '2') ?>
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
            navbar navbar-expand-lg sticky-top
            <?php echo $this->params->get('positions_navbar_bg_color', 'bg-white') ?> 
            <?php echo $this->params->get('positions_navbar_shadow', 'shadow-sm') ?> 
            <?php echo 'py-' . $this->params->get('positions_navbar_spacing', '3') ?>
        ">
        <div class="<?php echo $this->params->get('positions_navbar_container', 'container') ?>">
            <a class="navbar-brand" href="<?php echo $this->baseurl; ?>/">
                Navbar
            </a>
            <button 
                class="navbar-toggler" 
                type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" 
                aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <jdoc:include type="modules" name="mainmenu-desktop" style="none" />
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

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

    <jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
