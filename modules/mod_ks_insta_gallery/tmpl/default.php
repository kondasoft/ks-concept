<?php

/**
 * @package     KS Insta Gallery
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
$model->setState('list.limit', $params->get('limit', 2));
$articles = $model->getItems();
// print_r($articles)

?>

<section
    id="ks-insta-gallery-<?php echo $module->id; ?>"
    class="
        ks-insta-gallery
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-white text-dark')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    ">
    <h2 
        id="ks-insta-gallery-title-<?php echo $module->id ?>"
        class="
            title text-center mb-3 
            <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>
            <?php if (!$params->get('title_show', 1)) : ?>visually-hidden<?php endif ?>
        ">
        <?php echo htmlspecialchars($params->get('title', 'Latest From Instagram')); ?>
    </h2>
    <?php if ($params->get('description_show', 1)) : ?>
        <div class="description text-center mb-7 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
            <?php echo strip_tags($params->get('description', '<p>Write some optional description for this section.</p>'), '<p><a><br><br/><strong>'); ?>
        </div>
    <?php endif ?>
    <?php if ($params->get('btn_show', 1)) : ?>
        <div class="text-center">
            <a 
                class="btn mt-n2 mb-9 <?php echo htmlspecialchars($params->get('btn_color', 'btn-primary') ) ?>" 
                href="<?php echo htmlspecialchars($params->get('btn_url', '')) ?>"
                target="_blank">
                <?php echo htmlspecialchars($params->get('btn_text', '')) ?>
            </a>
        </di>
    <?php endif ?>
    <div 
        class="splide" 
        role="group" 
        data-autoscroll-speed="<?php echo htmlspecialchars($params->get('slider_autoscroll_speed', '1')) ?>"
        data-arrows="<?php echo htmlspecialchars($params->get('slider_arrows', '1')) ?>"
        data-pagination="<?php echo htmlspecialchars($params->get('slider_pagination', '0')) ?>"
        data-easing="<?php echo htmlspecialchars($params->get('slider_easing', 'cubic-bezier(.42,.65,.27,.99)')) ?>"
        data-speed="<?php echo htmlspecialchars($params->get('slider_speed', '500')) ?>"
        data-gap="<?php echo htmlspecialchars($params->get('slider_gap', '0')) ?>"
        data-breakpoint-xs="<?php echo htmlspecialchars($params->get('breakpoint_xs', 1)) ?>"
        data-breakpoint-sm="<?php echo htmlspecialchars($params->get('breakpoint_sm', 2)) ?>"
        data-breakpoint-md="<?php echo htmlspecialchars($params->get('breakpoint_md', 3)) ?>"
        data-breakpoint-lg="<?php echo htmlspecialchars($params->get('breakpoint_lg', 3)) ?>"
        data-breakpoint-xl="<?php echo htmlspecialchars($params->get('breakpoint_xl', 4)) ?>"
        data-breakpoint-xxl="<?php echo htmlspecialchars($params->get('breakpoint_xxl', 4)) ?>"
        aria-labelledby="ks-insta-gallery-title-<?php echo $module->id ?>">
        <div class="splide__track p-2">
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
                        if ($item_images->image_intro_caption) {
                            $likes = substr($item_images->image_intro_caption, 0, strpos($item_images->image_intro_caption, 'likes'));
                            $comments = substr($item_images->image_intro_caption, strpos($item_images->image_intro_caption, ',') + 1);
                            $comments = substr($comments, 0, strpos($comments, 'comments'));
                        }
                    ?>
                    <li class="splide__slide <?php echo $item->title ?>">
                        <div class="img-wrapper">
                            <?php if ($item_urls->urla) : ?>
                                <a href="<?php echo htmlspecialchars($item_urls->urla) ?>" target="_blank">
                            <?php endif ?>
                                <img class="img-fluid"
                                    src="<?php echo htmlspecialchars($img); ?>"
                                    alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>"
                                    width="<?php echo htmlspecialchars($img_size[0]) ?>"
                                    height="<?php echo htmlspecialchars($img_size[1]) ?>"
                                    loading="lazy">
                                <?php if ($item_images->image_intro_caption) : ?>
                                    <span class="likes-comments-wrapper">
                                        <span class="likes-comments-wrapper-likes">
                                            <?php echo htmlspecialchars($likes); ?>
                                        </span>
                                        <span class="likes-comments-wrapper-comments">
                                            <?php echo htmlspecialchars($comments); ?>
                                        </span>
                                    </span>
                                <?php endif ?>
                            <?php if ($item_urls->urla) : ?>
                                </a>
                            <?php endif ?>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>
