<?php

/**
 * @package     KS Testimonials
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

// $model = JModelLegacy::getInstance('Articles', 'ContentModel');
$model = $app->bootComponent('com_content')->getMVCFactory()->createModel('Articles', 'Site', ['ignore_request' => true]);
$model->setState('params', $app->getParams());
$model->setState('filter.category_id', htmlspecialchars($params->get('category')));
$model->setState('filter.published', 1);
$model->setState('list.limit', $params->get('limit', 10));
$articles = $model->getItems();
// print_r($articles)

?>

<section
    id="ks-testimonials-<?php echo $module->id; ?>"
    class="
        ks-testimonials overflow-hidden
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-white text-dark')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    ">
    <div class="<?php echo htmlspecialchars($params->get('container', 'container')) ?> ">
        <div class="mx-auto" style="<?php echo 'max-width: ' . htmlspecialchars($params->get('max_width', '1200')) . 'px' ?>">
            <h2 
                id="ks-testimonials-title-<?php echo $module->id ?>"
                class="
                    title text-center mb-3 
                    <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>
                    <?php if (!$params->get('title_show', 1)) : ?>visually-hidden<?php endif ?>
                ">
                <?php echo htmlspecialchars($params->get('title', 'Testimonials')); ?>
            </h2>
            <?php if ($params->get('description_show', 1)) : ?>
                <div class="description text-center mb-5 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                    <?php echo strip_tags($params->get('description', '<p>Write some optional description for this section.</p>'), '<p><a><br><br/><strong>'); ?>
                </div>
            <?php endif ?>
            <div 
                class="splide" 
                role="group" 
                data-arrows="<?php echo htmlspecialchars($params->get('slider_arrows', 1)) ?>"
                data-pagination="<?php echo htmlspecialchars($params->get('slider_pagination', 1)) ?>"
                data-easing="<?php echo htmlspecialchars($params->get('slider_easing', 'cubic-bezier(.42,.65,.27,.99)')) ?>"
                data-speed="<?php echo htmlspecialchars($params->get('slider_speed', '500')) ?>"
                data-autoplay="<?php echo htmlspecialchars($params->get('slider_autoplay', 1)) ?>"
                data-interval="<?php echo htmlspecialchars($params->get('slider_interval', 5000)) ?>"
                data-rewind="<?php echo htmlspecialchars($params->get('slider_rewind', 1)) ?>"
                aria-labelledby="ks-testimonials-title-<?php echo $module->id ?>">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($articles as $i => &$item) : ?>
                            <?php 
                                $item_images = json_decode($item->images);
                                $item_urls = json_decode($item->urls);
                                $img = substr($item_images->image_intro, 0, strpos($item_images->image_intro, '#'));
                                $img_size = $img ? getimagesize(JPATH_BASE . '/' . $img) : null;
                                if ($item_urls->urlatext) {
                                    $item_url = empty($item_urls->urla) ? Route::_(RouteHelper::getArticleRoute($item->id, $item->catid, $item->language)) : $item_urls->urla;
                                }
                                $author = $item_images->image_intro_caption;
                                if (str_contains($author, '|')) {
                                    $author = substr($item_images->image_intro_caption, 0, strpos($item_images->image_intro_caption, '|'));
                                    $author_subtitle = substr($item_images->image_intro_caption, strpos($item_images->image_intro_caption, '|') + 1);
                                }
                            ?>
                            <li class="splide__slide">
                                <div class="row align-items-lg-center">
                                    <div class="col-lg-8">
                                        <div class="text-center text-lg-start mb-7 mb-lg-0">
                                            <?php if ($params->get('item_title_show', 1)) : ?>
                                                <h3 class="item-title mb-3 <?php echo htmlspecialchars($params->get('item_title_size', 'h3')) ?>">
                                                    <?php echo htmlspecialchars($item->title); ?>
                                                </h3>
                                            <?php endif ?>
                                            <?php if ($params->get('item_stars_show', 1)) : ?>
                                                <div class="item-star-rating d-inline-flex mb-4 mx-n1 <?php echo htmlspecialchars($params->get('item_stars_color', 'text-primary')) ?>">
                                                    <?php for ($i = 0; $i < 5; $i++) :?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-star-fill m-1" viewBox="0 0 16 16">
                                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                        </svg>
                                                    <?php endfor ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if ($params->get('item_description_show', 1)) : ?>
                                                <div class="item-description <?php echo htmlspecialchars($params->get('item_description_size', 'fs-6')) ?>">
                                                    <?php echo strip_tags($item->introtext, '<p><a><br><br/><strong><em>'); ?>
                                                </div>
                                            <?php endif ?>
                                            <?php if ($params->get('item_btn_show', 1) && $item_urls->urlatext) : ?>
                                                <a 
                                                    class="btn mt-5 mb-5 <?php echo htmlspecialchars($params->get('item_btn_color', 'btn-primary') ) ?>" 
                                                    href="<?php echo htmlspecialchars($item_urls->urla) ?>"
                                                    target="<?php if ($item_urls->targeta == 1): ?>_blank<?php endif ?>">
                                                    <?php echo htmlspecialchars($item_urls->urlatext) ?>
                                                </a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <div class="img-wrapper position-relative">
                                                <img 
                                                    class="img-fluid <?php echo htmlspecialchars($params->get('img_border', 'rounded-circle')) ?>"
                                                    src="<?php echo htmlspecialchars($img); ?>"
                                                    alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>"
                                                    width="<?php echo htmlspecialchars($img_size[0]) ?>"
                                                    height="<?php echo htmlspecialchars($img_size[1]) ?>"
                                                    loading="lazy"
                                                    style="max-width: <?php echo htmlspecialchars($params->get('item_img_max_width', '200')) . 'px' ?>">
                                            </div>    
                                            <?php if ($author) : ?>
                                                <p class="item-author h6 mt-4 mb-0">
                                                    <?php echo htmlspecialchars($author); ?>
                                                </p>
                                                <?php if (isset($author_subtitle)) : ?>
                                                    <p class="item-author-subtitle mt-0 mb-0 opacity-75">
                                                        <?php echo htmlspecialchars($author_subtitle); ?>
                                                    </p>
                                                <?php endif ?>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
