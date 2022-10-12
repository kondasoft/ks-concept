<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$template = JFactory::getApplication()->getTemplate(true);
?>

<?php // var_dump($app->getMenu()->getActive()) ?>

<ul 
    id="mainmenu-mobile"
    class="nav flex-column <?php echo $class_sfx ?>">
    <?php foreach ($list as $i => &$item) : ?>
        <?php if ($item->level == 1) : ?>
            <?php if (!$item->deeper) : ?>
                <li class="nav-item level-1">
                    <a 
                        class="
                            nav-link 
                            <?php echo $item->anchor_css ?> 
                            <?php if ($item->id == $active_id) : ?>active<?php endif ?>
                            <?php if($item->getParams()->get('aliasoptions')  == $active_id) : ?>active<?php endif ?>
                        " 
                        href="<?php echo $item->flink ?>"
                        aria-current="<?php if ($item->id == $active_id) : ?>page<?php endif ?>"
                        target="<?php if ($item->browserNav) : ?>_blank<?php endif ?>">
                        <?php echo $item->title ?>
                    </a>
                </li>
            <?php else : ?>
                <li class="nav-item level-1">
                    <a 
                        class="nav-link" 
                        href="#mainmenu-mobile-collapse-<?php echo $i ?>"
                        aria-controls="mainmenu-mobile-collapse-<?php echo $i ?>"
                        role="button"
                        data-bs-toggle="collapse"
                        aria-expanded="false">
                        <?php echo $item->title ?>
                    </a>
                    <div id="mainmenu-mobile-collapse-<?php echo $i ?>" class="collapse">
                        <ul class="nav flex-column">
                            <?php foreach ($list as $i => &$child_item) : ?>
                                <?php if ($child_item->parent_id == $item->id) : ?>
                                    <?php // var_dump($child_item) ?>
                                    <li class="nav-item level-2 <?php if ($child_item->deeper) : ?>has-children<?php endif ?>">
                                        <?php if ($child_item->type == 'separator') : ?>
                                            <hr class="dropdown-divider">
                                        <?php else : ?>
                                            <a 
                                                class="
                                                    nav-link 
                                                    <?php echo $child_item->anchor_css ?> 
                                                    <?php if ($child_item->id == $active_id) : ?>active<?php endif ?>
                                                    <?php if($child_item->getParams()->get('aliasoptions')  == $active_id) : ?>active<?php endif ?>
                                                " 
                                                href="<?php echo $child_item->flink ?>"
                                                aria-current="<?php if ($child_item->id == $active_id) : ?>page<?php endif ?>"
                                                target="<?php if ($child_item->browserNav) : ?>_blank<?php endif ?>">
                                                <?php if ($child_item->menu_image) : ?>
                                                    <div class="nav-link-img text-center mb-3">
                                                        <?php $menuImage = substr($child_item->menu_image, 0, strpos($child_item->menu_image, '#')); ?>
                                                        <?php $imageImageSize = $menuImage ? getimagesize(JPATH_BASE . '/' . $menuImage) : null; ?>
                                                        <img 
                                                            class="img-fluid mb-2 img-thumbnail"
                                                            src="<?php echo htmlspecialchars($menuImage); ?>"
                                                            alt=""
                                                            width="<?php echo htmlspecialchars($imageImageSize[0]) ?>"
                                                            height="<?php echo htmlspecialchars($imageImageSize[1]) ?>"
                                                            loading="lazy">
                                                        <?php echo $child_item->title ?>
                                                    </div>
                                                <?php else : ?>
                                                    <?php echo $child_item->title ?>
                                                <?php endif ?>
                                            </a>
                                        <?php endif ?>
                                        <?php if ($child_item->deeper) : ?>
                                            <ul class="list-unstyled mb-3">
                                                <?php foreach ($list as $i => &$grandchild_item) : ?>
                                                    <?php if ($grandchild_item->parent_id == $child_item->id) : ?>
                                                        <?php // var_dump($grandchild_item) ?>
                                                        <li class="nav-item level-3">
                                                            <a 
                                                                class="
                                                                    nav-link
                                                                    <?php echo $grandchild_item->anchor_css ?> 
                                                                    <?php if ($grandchild_item->id == $active_id) : ?>active<?php endif ?>
                                                                    <?php if ($grandchild_item->getParams()->get('aliasoptions') == $active_id) : ?>active<?php endif ?>
                                                                " 
                                                                href="<?php echo $grandchild_item->flink ?>"
                                                                aria-current="<?php if ($grandchild_item->id == $active_id) : ?>page<?php endif ?>"
                                                                target="<?php if ($grandchild_item->browserNav) : ?>_blank<?php endif ?>">
                                                                <svg width="5" height="5" viewBox="0 0 120 120" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <circle id="Oval" fill="currentColor" cx="60" cy="60" r="60"></circle>
                                                                    </g>
                                                                </svg>
                                                                <?php echo $grandchild_item->title ?>
                                                            </a>
                                                        </li>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </ul>
                                        <?php endif ?>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
</ul>