<?php

/**
 * @package     KS Animated Counters
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
    id="ks-animated-counters-<?php echo $module->id; ?>"
    class="
        ks-animated-counters
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-white text-dark')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    ">
    <div class="<?php echo htmlspecialchars($params->get('container', 'container')) ?> ">
        <h2 
                id="ks-animated-counters-title-<?php echo $module->id ?>"
                class="
                    title text-center mb-3 
                    <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>
                    <?php if (!$params->get('title_show', 1)) : ?>visually-hidden<?php endif ?>
                ">
                <?php echo htmlspecialchars($params->get('title', 'Animated Counters')); ?>
            </h2>
        <?php if ($params->get('description_show', 1)) : ?>
            <div class="description text-center mb-5 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                <?php echo strip_tags($params->get('description', '<p>Write some optional description for this section.</p>'), '<p><a><br><br/><strong>'); ?>
            </div>
        <?php endif ?>
        <ul 
            class="
                list-unstyled row mx-n3 mx-lg-n4 mb-0
                <?php echo 'row-cols-' . htmlspecialchars($params->get('breakpoint_xs', '1')) ?>
                <?php echo 'row-cols-sm-' . htmlspecialchars($params->get('breakpoint_sm', '2')) ?>
                <?php echo 'row-cols-md-' . htmlspecialchars($params->get('breakpoint_md', '2')) ?>
                <?php echo 'row-cols-lg-' . htmlspecialchars($params->get('breakpoint_lg', '4')) ?>
                <?php echo 'row-cols-xl-' . htmlspecialchars($params->get('breakpoint_xl', '4')) ?>
                <?php echo 'row-cols-xxl-' . htmlspecialchars($params->get('breakpoint_xxl', '4')) ?>
            " 
            aria-labelledby="ks-animated-counters-title-<?php echo $module->id ?>">
            <?php foreach ($articles as $i => &$item) : ?>
                <li class="p-3 p-lg-4 enter-view">
                    <div class="<?php echo htmlspecialchars($params->get('item_text_align', 'text-center')) ?>">
                        <?php 
                            $number = substr($item->title, 0, strpos($item->title, '|'));
                            $title = substr($item->title, strpos($item->title, '|') + 1);
                            $item_urls = json_decode($item->urls);
                        ?>
                        <p 
                            class="ks-animated-counters-number mb-1"
                            data-number="<?php echo preg_replace('~\D~', '', $number); ?>"
                            data-duration="<?php echo htmlspecialchars($params->get('item_number_duration', '3000')) ?>"
                            style="<?php echo 'font-size: ' . htmlspecialchars($params->get('item_number_size', '64')) . 'px' ?>">
                            <span class="visually-hidden">
                                <?php echo preg_replace('~\D~', '', $number); ?>
                            </span>
                            &nbsp;
                        </p>
                        <?php if ($params->get('item_title_show', 1)) : ?>
                            <h3 class="item-title mb-2 <?php echo htmlspecialchars($params->get('item_title_size', 'h5')) ?>">
                                <?php echo htmlspecialchars($title); ?>
                            </h3>
                        <?php endif ?>
                        <?php if ($params->get('item_description_show', 1)) : ?>
                            <div class="item-description <?php echo htmlspecialchars($params->get('item_description_size', 'fs-6')) ?>">
                                <?php echo strip_tags($item->introtext, '<p><a><br><br/><strong>'); ?>
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
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</section>
