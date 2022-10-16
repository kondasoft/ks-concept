<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

if ($module->content === null || $module->content === '') {
    return;
}

$moduleTag              = $params->get('module_tag', 'div');
$moduleAttribs          = [];
$moduleAttribs['class'] = $module->position . ' footer-mod ' . htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');
$headerTag              = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerAttribs          = [];
$headerAttribs['class'] = 'mod-title d-none d-lg-block ' . htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');

?>

<div class="col-lg">
    <button 
        class="accordion-button collapsed d-lg-none" 
        data-bs-toggle="collapse" 
        data-bs-target="#footer-mod-collapse-<?php echo $module->id; ?>"
        aria-expanded="false" 
        aria-controls="footer-mod-collapse-<?php echo $module->id; ?>">
        <?php echo htmlspecialchars($module->title); ?>
    </button>
    <div id="footer-mod-collapse-<?php echo $module->id; ?>" class="collapse d-lg-block">
        <<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
            <?php if ($module->showtitle) : ?>
                <?php echo '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $module->title . '</' . $headerTag . '>'; ?>
            <?php endif; ?>
            <div class="py-4 py-lg-0">
                <?php echo $module->content; ?>
            </div>
        </<?php echo $moduleTag; ?>>
    </div>
</div>