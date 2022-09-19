<?php

/**
 * @package     KondaSoft
 * @subpackage  Templates.cassiopeia
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<a class="navbar-brand p-0 m-0" href="<?php echo $this->baseurl . '/' ; ?>">
    <?php if ($this->params->get('logo')) : ?>
        <img
            src="<?php echo Uri::root(true) . '/' . htmlspecialchars($this->params->get('general_logo_media'), ENT_QUOTES) ?>"
            alt="<?php echo $sitename; ?>"
            class="img-fluid"
            width="<?php echo htmlspecialchars($this->params->get('general_logo_width', '120')) ?> "
            height=""
            loading="eager">
    <?php else : ?>
        <?php echo $sitename; ?>
    <?php endif ?>
</a>