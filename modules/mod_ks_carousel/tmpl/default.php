<?php

/**
 * @package     KS Carousel
 * @subpackage  mod_ks_carousel
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

// $model = JModelLegacy::getInstance('Articles', 'ContentModel');
$model = $app->bootComponent('com_content')->getMVCFactory()->createModel('Articles', 'Site', ['ignore_request' => true]);
$model->setState('params', $app->getParams());
$model->setState('filter.category_id', htmlspecialchars($params->get('category')));
$model->setState('list.limit', $params->get('limit', 3));
$articles = $model->getItems();
// print_r($articles)

?>

<div
    id="carousel-<?php echo $module->id; ?>"
    class="
        carousel 
        <?php echo htmlspecialchars($params->get('animation', 'slide')) ?> 
        <?php echo htmlspecialchars($params->get('carousel_style', 'carousel-light')) ?> 
    "
    data-bs-ride="<?php if ($params->get('autoplay', 1)) : ?>carousel<?php else : ?>false<?php endif ?>">
    <?php if ($params->get('show_indicators', 1)) : ?>
        <div class="carousel-indicators">
            <?php foreach ($articles as $i => &$item) : ?>
                <button 
                    type="button" 
                    data-bs-target="#carousel-<?php echo $module->id; ?>" 
                    data-bs-slide-to="<?php echo $i ?>" 
                    class="<?php if ($i == 0) : ?>active<?php endif ?>" 
                    aria-current="<?php if ($i == 0) : ?>true<?php endif ?>"
                    aria-label="Slide <?php echo $i + 1 ?>"></button>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <div class="carousel-inner">
        <?php foreach ($articles as $i => &$item) : ?>
            <?php 
                $item_images = json_decode($item->images);
                $item_urls = json_decode($item->urls);
                $image_desktop = substr($item_images->image_intro, 0, strpos($item_images->image_intro, '#'));
                $image_desktop_size = getimagesize(JPATH_BASE . '/' . $image_desktop);
                $image_mobile = str_replace('.', '-mobile.', $image_desktop);
                $image_mobile_size = getimagesize(JPATH_BASE . '/' . $image_mobile);
            ?>
            <div class="carousel-item <?php if ($i == 0) : ?>active<?php endif ?>">
                <img 
                    src="<?php echo htmlspecialchars($image_mobile) ?>" 
                    class="img-fluid w-100 d-sm-none" 
                    width="<?php echo htmlspecialchars($image_mobile_size[0]) ?>"
                    height="<?php echo htmlspecialchars($image_mobile_size[1]) ?>"
                    alt="<?php echo htmlspecialchars($item_images->image_intro_alt) ?>"
                    loading="<?php echo htmlspecialchars($params->get('loading', 'eager')) ?>"
                    style="min-height: <?php echo htmlspecialchars($params->get('img_min_height', '400')) ?>px; object-fit: cover;">
                <img 
                    src="<?php echo htmlspecialchars($image_desktop) ?>" 
                    class="img-fluid w-100 d-none d-sm-block" 
                    width="<?php echo htmlspecialchars($image_desktop_size[0]) ?>"
                    height="<?php echo htmlspecialchars($image_desktop_size[1]) ?>"
                    alt="<?php echo htmlspecialchars($item_images->image_intro_alt) ?>"
                    loading="<?php echo htmlspecialchars($params->get('loading', 'eager')) ?>"
                    style="min-height: <?php echo htmlspecialchars($params->get('img_min_height', '400')) ?>px; object-fit: cover;">
                <?php if ($params->get('show_caption', 1)) : ?>
                    <div class="carousel-caption">
                        <div class="animate__animated animate__faster animate__fadeInUp" style="animation-delay: 600ms">
                            <h2 class="title mb-3 <?php echo htmlspecialchars($params->get('caption_title_size', 'h2')) ?>">
                                <?php echo htmlspecialchars($item->title); ?>
                            </h5>
                        </div>
                        <div class="animate__animated animate__faster animate__fadeInUp" style="animation-delay: 800ms">
                            <div class="description mb-6 <?php echo htmlspecialchars($params->get('caption_description_size', 'fs-5')) ?>">
                                <?php echo strip_tags($item->introtext, '<p><a>'); ?>
                            </div>
                        </div>
                        <?php if ($item_urls->urla || $item_urls->urlb) : ?>
                            <div class="animate__animated animate__faster animate__zoomIn" style="animation-delay: 1000ms">
                                <div class="d-flex justify-content-center mb-6">
                                    <?php if ($item_urls->urla) : ?>
                                        <a 
                                            class="btn px-6 m-2 <?php echo htmlspecialchars($params->get('caption_btn_2_color', 'btn-primary') ) ?>" 
                                            href="<?php echo htmlspecialchars($item_urls->urla) ?>"
                                            target="<?php if ($item_urls->targeta == 1): ?>_blank<?php endif ?>">
                                            <?php echo htmlspecialchars($item_urls->urlatext) ?>
                                        </a>
                                    <?php endif ?>
                                    <?php if ($item_urls->urlb) : ?>
                                        <a 
                                            class="btn m-2 <?php echo htmlspecialchars($params->get('caption_btn_2_color', 'btn-secondary') ) ?>" 
                                            href="<?php echo htmlspecialchars($item_urls->urlb) ?>"
                                            target="<?php if ($item_urls->targetb == 1): ?>_blank<?php endif ?>">
                                            <?php echo htmlspecialchars($item_urls->urlbtext) ?>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
    <?php if ($params->get('show_controls', 1)) : ?>
        <button 
            class="carousel-control-prev" 
            type="button" 
            data-bs-target="#carousel-<?php echo $module->id; ?>" 
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo JText::_('MOD_KS_CAROUSEL_PREV') ?></span>
        </button>
        <button 
            class="carousel-control-next" 
            type="button" 
            data-bs-target="#carousel-<?php echo $module->id; ?>" 
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"><?php echo JText::_('MOD_KS_CAROUSEL_NEXT') ?></span>
        </button>
    <?php endif ?>
</div>
