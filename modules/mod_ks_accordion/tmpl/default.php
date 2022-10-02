<?php

/**
 * @package     KS Accordion
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
$model->setState('list.limit', $params->get('limit', 10));
$articles = $model->getItems();
// print_r($articles)

?>

<section
    id="ks-accordion-<?php echo $module->id; ?>"
    class="
        ks-accordion
        <?php echo htmlspecialchars($params->get('accordion_style', 'accordion-default')) ?>
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    "
    style="background-color: <?php echo htmlspecialchars($params->get('bg_color', '#ffffff')) ?>">
    <div class="container">
        <div class="mx-auto" style="<?php echo 'max-width: ' . htmlspecialchars($params->get('max_width', '600')) . 'px' ?>">
            <?php if ($params->get('title_show', 1)) : ?>
                <h2 class="title text-center mb-3 <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>">
                    <?php echo htmlspecialchars($params->get('title', 'Accordion (F.A.Q)')); ?>
                </h2>
            <?php endif ?>
            <?php if ($params->get('description_show', 1)) : ?>
                <div class="description text-center mb-7 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                    <?php echo strip_tags($params->get('description', '<p>Write some optional description for this section.</p>'), '<p><a><br><br/><strong>'); ?>
                </div>
            <?php endif ?>
            <div id="accordion-<?php echo $module->id; ?>" class="accordion">
                <?php foreach ($articles as $i => &$item) : ?>
                    <div class="accordion-item">
                        <h2 
                            id="<?php echo 'accordion-heading-' . $module->id . 'index-' .$i ; ?>" 
                            class="accordion-header">
                            <button 
                                class="accordion-button <?php if ($i > 0) : ?>collapsed<?php endif ?>" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#<?php echo 'accordion-collapse-' . $module->id . 'index-' .$i ; ?>" 
                                aria-expanded="<?php if ($i === 0) : ?>true<?php else : ?>false<?php endif ?>" 
                                aria-controls="<?php echo 'accordion-collapse-' . $module->id . 'index-' .$i ; ?>">
                                <?php echo htmlspecialchars($item->title); ?>
                            </button>
                        </h2>
                        <div 
                            id="<?php echo 'accordion-collapse-' . $module->id . 'index-' .$i ; ?>" 
                            class="accordion-collapse collapse <?php if ($i === 0) : ?>show<?php endif ?>" 
                            aria-labelledby="<?php echo 'accordion-heading-' . $module->id . 'index-' .$i ; ?>" 
                            data-bs-parent="#accordion-<?php echo $module->id; ?>">
                            <div class="accordion-body">
                                <?php echo strip_tags($item->introtext, '<p><a><br><br/><strong>'); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
