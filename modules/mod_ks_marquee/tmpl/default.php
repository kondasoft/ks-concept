<?php

/**
 * @package     KS Marquee
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$text = explode(',', htmlspecialchars($params->get('text', 'Spectacular, Mind-blowing, Breathtaking, Eye-catching, Out of this world, magnificient')));
?>

<div
    id="ks-marquee-<?php echo $module->id; ?>"
    class="
        ks-marquee overflow-hidden
        <?php echo htmlspecialchars($params->get('bg_color', 'bg-dark text-white')) ?> 
        <?php echo 'py-' . htmlspecialchars($params->get('spacing', '3')) ?>
    ">
    <ul 
        class="
            ks-marquee-list list-unstyled
            <?php echo htmlspecialchars($params->get('font_weight', 'fw-normla')) ?>
            <?php echo htmlspecialchars($params->get('text_transform', 'text-capitalize')) ?>
        "
        data-module-id="<?php echo $module->id; ?>"
        data-animation-duration="<?php echo htmlspecialchars($params->get('animation_duration', '12s')) ?>"
        aria-label="<?php echo htmlspecialchars($params->get('list_label', 'Promotional Features')) ?>">
        <?php foreach ($text as $i => &$item) : ?>
            <li class="ks-marquee-list-item">
                <?php echo $item ?>
            </li>
        <?php endforeach ?>
    </ul>
</div>
