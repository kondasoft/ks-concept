<?php

/**
 * @package     KS Image Overlay With Text
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

if (!htmlspecialchars($params->get('img_mobile'))) {
    $imgMobileWidth = 1200;
    $imgMobileHeight = 1200;
} else {
    $imgMobile = htmlspecialchars($params->get('img_mobile'));
    $imgMobile = substr($imgMobile, 0, strpos($imgMobile, '#'));
    $imgMobileSize = getimagesize(JPATH_BASE . '/' . $imgMobile);
    $imgMobileWidth = $imgMobileSize[0];
    $imgMobileHeight = $imgMobileSize[1];
}

if (!htmlspecialchars($params->get('img_desktop'))) {
    $imgDesktopWidth = 1920;
    $imgDesktopHeight = 640;
} else {
    $imgDesktop = htmlspecialchars($params->get('img_desktop'));
    $imgDesktop = substr($imgDesktop, 0, strpos($imgDesktop, '#'));
    $imgDesktopSize = getimagesize(JPATH_BASE . '/' . $imgDesktop);
    $imgDesktopWidth = $imgDesktopSize[0];
    $imgDesktopHeight = $imgDesktopSize[1];
}
?>

<section
    id="ks-image-overlay-with-text-<?php echo $module->id; ?>"
    class="
        ks-image-overlay-with-text enter-view
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    ">
    <img 
        class="img-fluid img-mobile d-lg-none" 
        src="<?php echo htmlspecialchars($params->get('img_mobile', 'https://via.placeholder.com/1200x1200')) ?>"
        alt="<?php echo htmlspecialchars($params->get('img_alt', 'Sample placeholder image')) ?>"
        width="<?php echo htmlspecialchars($imgMobileWidth) ?>"
        height="<?php echo htmlspecialchars($imgMobileHeight) ?>"
        loading="<?php echo htmlspecialchars($params->get('loading', 'lazy')) ?>"
        style="<?php echo 'opacity: ' . htmlspecialchars($params->get('img_opacity', '70')) . '%' ?>"
        data-parallax-orientation="<?php echo htmlspecialchars($params->get('parallax_orientation', 'up')) ?>"
        data-parallax-scale="<?php echo htmlspecialchars($params->get('parallax_scale', '20')) ?>">
    <img 
        class="img-fluid img-desktop d-none d-lg-block" 
        src="<?php echo htmlspecialchars($params->get('img_mobile', 'https://via.placeholder.com/1920x640')) ?>"
        alt="<?php echo htmlspecialchars($params->get('img_alt', 'Sample placeholder image')) ?>"
        width="<?php echo htmlspecialchars($imgDesktopWidth) ?>"
        height="<?php echo htmlspecialchars($imgDesktopHeight) ?>"
        loading="<?php echo htmlspecialchars($params->get('loading', 'lazy')) ?>"
        style="<?php echo 'opacity: ' . htmlspecialchars($params->get('img_opacity', '70')) . '%' ?>"
        data-parallax-orientation="<?php echo htmlspecialchars($params->get('parallax_orientation', 'up')) ?>"
        data-parallax-scale="<?php echo htmlspecialchars($params->get('parallax_scale', '20')) ?>">
    <div class="container" style="<?php echo 'max-width: ' . htmlspecialchars($params->get('max_width', '600')) . 'px' ?>">
        <div class="
            ks-image-overlay-with-text--inner
            <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
            <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        ">
            <?php if ($params->get('title_show', 1)) : ?>
                <h2 class="title mb-3 <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>">
                    <?php echo htmlspecialchars($params->get('title', 'Image Overlay With Text')); ?>
                </h2>
            <?php endif ?>
            <?php if ($params->get('description_show', 1)) : ?>
                <div class="description mb-7 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                    <?php echo strip_tags($params->get('description', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consectetur risus nulla. Proin molestie et dui nec pharetra. In sed volutpat velit. Cras sodales suscipit neque venenatis porttitor. Aenean eget mattis orci, vitae imperdiet enim.</p>'), '<p><a><br><br/><strong>'); ?>
                </div>
            <?php endif ?>
            <?php if ($params->get('btn_show', 1)) : ?>
                <a 
                    class="btn <?php echo htmlspecialchars($params->get('btn_color', 'btn-primary')) ?>" 
                    href="<?php echo htmlspecialchars($params->get('btn_url', '#')) ?>">
                    <?php echo htmlspecialchars($params->get('btn_text', 'Learn more')) ?>
                </a>
            <?php endif ?>
        </div>
    </div>
</section>