<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

defined('_JEXEC') || die();

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

/** @var  \Akeeba\Component\AkeebaBackup\Administrator\View\Log\HtmlView  $this */

HTMLHelper::_('formbehavior.chosen');
?>

<?php if(isset($this->logs) && count($this->logs)): ?>
<form name="adminForm" id="adminForm" action="index.php" method="post"
	  class="row row-cols-lg-auto g-3 align-items-center p-2 my-2 border bg-light">
    <div class="col-12">
		<label for="tag"><?= Text::_('COM_AKEEBABACKUP_LOG_CHOOSE_FILE_TITLE')?></label>
	</div>
    <div class="col-12">
	    <?= HTMLHelper::_('select.genericlist', $this->logs, 'tag', [
		    'list.select' => $this->tag,
		    'list.attr'   => [
			    'class'    => 'advancedSelect form-select',
			    'onchange' => 'document.forms.adminForm.submit();',
		    ], 'id'       => 'comAkeebaLogTagSelector',
	    ]) ?>
    </div>

	<?php if(!empty($this->tag)): ?>
        <div class="col-12">
            <a class="btn btn-primary" href="<?= $this->escape(JUri::base()) ?>index.php?option=com_akeebabackup&view=Log&task=download&tag=<?= $this->escape($this->tag) ?>">
                <span class="fa fa-download"></span>
				<?= Text::_('COM_AKEEBABACKUP_LOG_LABEL_DOWNLOAD') ?>
            </a>
        </div>
	<?php endif ?>

	<input name="option" value="com_akeebabackup" type="hidden" />
	<input name="view" value="Log" type="hidden" />
	<?= HTMLHelper::_('form.token') ?>
</form>
<?php endif ?>

<?php if(!empty($this->tag)): ?>
    <?php if ($this->logTooBig): ?>
        <div class="alert alert-warning">
            <p>
                <?= Text::sprintf('COM_AKEEBABACKUP_LOG_SIZE_WARNING', number_format($this->logSize / (1024 * 1024), 2)) ?>
            </p>
            <a class="btn btn-dark" id="showlog" href="#">
                <?= Text::_('COM_AKEEBABACKUP_LOG_SHOW_LOG') ?>
            </a>
        </div>
    <?php endif ?>

    <div id="iframe-holder" class="border p-0"
		 style="display: <?= $this->logTooBig ? 'none' : 'block' ?>;">
		<?php if(!$this->logTooBig): ?>
            <iframe
                src="index.php?option=com_akeebabackup&view=Log&task=iframe&format=raw&tag=<?= urlencode($this->tag) ?>"
                width="99%" height="400px">
            </iframe>
		<?php endif ?>
    </div>
<?php endif ?>

<?php if( ! (isset($this->logs) && count($this->logs))): ?>
<div class="alert alert-danger">
	<?= Text::_('COM_AKEEBABACKUP_LOG_NONE_FOUND') ?>
</div>
<?php endif ?>