<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$template = JFactory::getApplication()->getTemplate(true);
?>

<ul 
    id="mainmenu-desktop"
    class="navbar-nav <?php echo $class_sfx ?>">
    <?php foreach ($list as $i => &$item) : ?>
        <?php // var_dump($item) ?>
        <?php if ($item->level == 1) : ?>
            <?php if (!$item->deeper) : ?>
                <li class="nav-item level-1">
                    <a 
                        class="nav-link <?php echo $item->anchor_css ?> <?php if ($item->id == $active_id) : ?>active<?php endif ?>" 
                        href="<?php echo $item->link ?>"
                        aria-current="<?php if ($item->id == $active_id) : ?>page<?php endif ?>"
                        target="<?php if ($item->browserNav) : ?>_blank<?php endif ?>">
                        <?php echo $item->title ?>
                    </a>
                </li>
            <?php else : ?>
                <li class="nav-item level-1 dropdown">
                    <a 
                        class="nav-link dropdown-toggle <?php echo $item->anchor_css ?> <?php if ($item->id == $active_id) : ?>active<?php endif ?>" 
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo $item->title ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach ($list as $i => &$child_item) : ?>
                            <?php if ($child_item->parent_id == $item->id) : ?>
                                <?php // var_dump($child_item) ?>
                                <li class="nav-item level-2">
                                    <a 
                                        class="dropdown-item <?php if ($child_item->id == $active_id) : ?>active<?php endif ?>" 
                                        href="<?php echo $child_item->link ?>"
                                        aria-current="<?php if ($child_item->id == $active_id) : ?>page<?php endif ?>"
                                        target="<?php if ($child_item->browserNav) : ?>_blank<?php endif ?>">
                                        <?php echo $child_item->title ?>
                                    </a>
                                    <ul class="list-unstyled">
                                        <?php foreach ($list as $i => &$grandchild_item) : ?>
                                            <?php if ($grandchild_item->parent_id == $child_item->id) : ?>
                                                <?php // var_dump($grandchild_item) ?>
                                                <li class="nav-item level-3">
                                                    <a 
                                                        class="dropdown-item test <?php if ($grandchild_item->id == $active_id) : ?>active<?php endif ?>" 
                                                        href="<?php echo $grandchild_item->link ?>"
                                                        aria-current="<?php if ($grandchild_item->id == $active_id) : ?>page<?php endif ?>"
                                                        target="<?php if ($grandchild_item->browserNav) : ?>_blank<?php endif ?>">
                                                        <?php echo $grandchild_item->title ?>
                                                    </a>
                                                </li>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
</ul>