<?php

/**
 * @package     KondaSoft
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$template = JFactory::getApplication()->getTemplate(true);
?>

<div class="cta-button-wrapper">
    <a
        class="cta-button btn <?php echo htmlspecialchars($template->params->get('layout_navbar_cta_button_color', 'btn-primary')) ?>"
        href="<?php echo htmlspecialchars($template->params->get('layout_navbar_cta_button_url', '#')) ?>">
        <?php echo htmlspecialchars($template->params->get('layout_navbar_cta_button_text', 'Contact us')) ?>
    </a>
</div>