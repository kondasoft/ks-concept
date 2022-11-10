<?php

/**
 * @package     KS Cards
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
    id="ks-cards-<?php echo $module->id; ?>"
    class="
        ks-cards
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-white text-dark')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    ">
    <div class="<?php echo htmlspecialchars($params->get('container', 'container')) ?> ">
        <h2 
            id="ks-cards-title-<?php echo $module->id ?>"
            class="
                title text-center mb-3 
                <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>
                <?php if (!$params->get('title_show', 1)) : ?>visually-hidden<?php endif ?>
            ">
            <?php echo htmlspecialchars($params->get('title', 'Cards')); ?>
        </h2>
        <?php if ($params->get('description_show', 1)) : ?>
            <div class="description text-center mb-5 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                <?php echo strip_tags($params->get('description', '<p>Write some optional description for this section.</p>'), '<p><a><br><br/><strong>'); ?>
            </div>
        <?php endif ?>
        <ul 
            class="
                list-unstyled row mx-n3 mx-lg-n4 mb-0
                <?php echo 'row-cols-' . htmlspecialchars($params->get('breakpoint_xs', '2')) ?>
                <?php echo 'row-cols-sm-' . htmlspecialchars($params->get('breakpoint_sm', '2')) ?>
                <?php echo 'row-cols-md-' . htmlspecialchars($params->get('breakpoint_md', '2')) ?>
                <?php echo 'row-cols-lg-' . htmlspecialchars($params->get('breakpoint_lg', '4')) ?>
                <?php echo 'row-cols-xl-' . htmlspecialchars($params->get('breakpoint_xl', '4')) ?>
                <?php echo 'row-cols-xxl-' . htmlspecialchars($params->get('breakpoint_xxl', '4')) ?>
            " 
            aria-labelledby="ks-cards-title-<?php echo $module->id ?>">
            <?php foreach ($articles as $i => &$item) : ?>
                <?php 
                    $item_images = json_decode($item->images);
                    $item_urls = json_decode($item->urls);
                    $img = substr($item_images->image_intro, 0, strpos($item_images->image_intro, '#'));
                    $img_size = $img ? getimagesize(JPATH_BASE . '/' . $img) : null;
                    if ($item_urls->urlatext) {
                        $item_url = empty($item_urls->urla) ? Route::_(RouteHelper::getArticleRoute($item->id, $item->catid, $item->language)) : $item_urls->urla;
                    }
                ?>
                <li class="p-3 p-lg-4">
                    <div class="<?php if ($params->get('item_card', 1)) : ?>card h-100<?php endif ?>">
                        <?php if ($params->get('item_img_show', 1) && $img) : ?>
                            <?php if ($item_url) : ?>
                                <a href="<?php echo htmlspecialchars($item_url) ?>">
                            <?php endif ?>
                                <img 
                                    class="
                                        img-fluid 
                                        <?php if ($params->get('item_card', 1)) : ?>
                                            card-img-top
                                        <?php else : ?>
                                            mb-4 <?php echo htmlspecialchars($params->get('img_border', 'img-thumbnail')) ?>
                                        <?php endif ?>
                                    "
                                    src="<?php echo htmlspecialchars($img); ?>"
                                    alt="<?php echo htmlspecialchars($item_images->image_intro_alt); ?>"
                                    width="<?php echo htmlspecialchars($img_size[0]) ?>"
                                    height="<?php echo htmlspecialchars($img_size[1]) ?>"
                                    loading="lazy">
                            <?php if ($item_url) : ?>
                                </a>
                            <?php endif ?>
                        <?php endif ?>
                        <div 
                            class="
                                <?php if ($params->get('item_card', 1)) : ?>card-body<?php endif ?>
                                <?php echo htmlspecialchars($params->get('item_text_align', '')) ?>
                            ">
                            <?php if ($params->get('item_title_show', 1)) : ?>
                                <h3 class="item-title mb-2 <?php echo htmlspecialchars($params->get('item_title_size', 'h5')) ?>">
                                    <?php echo htmlspecialchars($item->title); ?>
                                </h3>
                            <?php endif ?>
                            <?php if ($params->get('item_description_show', 1)) : ?>
                                <div class="item-description <?php echo htmlspecialchars($params->get('item_description_size', 'fs-6')) ?>">
                                    <?php echo strip_tags($item->introtext, '<p><a><br><br/><strong>'); ?>
                                </div>
                            <?php endif ?>
                            <?php if ($params->get('item_btn_show', 1) && $item_urls->urlatext) : ?>
                                <a 
                                    class="btn mt-5 <?php echo htmlspecialchars($params->get('item_btn_color', 'btn-primary') ) ?>" 
                                    href="<?php echo htmlspecialchars($item_url) ?>"
                                    target="<?php if ($item_urls->targeta == 1): ?>_blank<?php endif ?>">
                                    <?php echo htmlspecialchars($item_urls->urlatext) ?>
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</section>
