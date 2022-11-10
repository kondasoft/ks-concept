<?php

/**
 * @package     KS Image With Text
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

if (!htmlspecialchars($params->get('img'))) {
    $imgWidth = 900;
    $imgHeight = 600;
} else {
    $img = htmlspecialchars($params->get('img'));
    $img = substr($img, 0, strpos($img, '#'));
    $imgSize = getimagesize(JPATH_BASE . '/' . $img);
    $imgWidth = $imgSize[0];
    $imgHeight = $imgSize[1];
}
?>

<section
    id="ks-image-with-text-<?php echo $module->id; ?>"
    class="
        ks-image-with-text
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-white text-dark')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 11)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 11)) ?>
    ">
    <div class="<?php echo htmlspecialchars($params->get('container', 'container')) ?> ">
        <div class="row align-items-lg-center <?php echo htmlspecialchars($params->get('img_align_desktop', '')) ?>">
            <div class="col-lg-6">
            <img 
                class="img-fluid mb-6 mb-lg-0 w-100 <?php echo htmlspecialchars($params->get('img_border', 'img-thumbnail')) ?>" 
                src="<?php echo htmlspecialchars($params->get('img', 'https://via.placeholder.com/900x600')) ?>"
                alt="<?php echo htmlspecialchars($params->get('img_alt', 'Sample placeholder image')) ?>"
                width="<?php echo htmlspecialchars($imgWidth) ?>"
                height="<?php echo htmlspecialchars($imgHeight) ?>"
                loading="<?php echo htmlspecialchars($params->get('loading', 'lazy')) ?>">
            </div>
            <div class="col-lg-6">
                <?php if ($params->get('title_show', 1)) : ?>
                    <h2 class="title mb-3 <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>">
                        <?php echo htmlspecialchars($params->get('title', 'Image With Text')); ?>
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
    </div>
</section>
