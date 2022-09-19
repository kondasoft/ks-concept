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
    id="mainmenu-mobile"
    class="nav flex-column <?php echo $class_sfx ?>">
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
                <li class="nav-item level-1">
                    <a 
                        class="nav-link <?php echo $item->anchor_css ?> <?php if ($item->id == $active_id) : ?>active<?php endif ?>" 
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
                                    <li class="nav-item level-2">
                                        <a 
                                            class="nav-link <?php if ($child_item->id == $active_id) : ?>active<?php endif ?>" 
                                            href="<?php echo $child_item->link ?>"
                                            aria-current="<?php if ($child_item->id == $active_id) : ?>page<?php endif ?>"
                                            target="<?php if ($child_item->browserNav) : ?>_blank<?php endif ?>">
                                            <?php echo $child_item->title ?>
                                        </a>
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