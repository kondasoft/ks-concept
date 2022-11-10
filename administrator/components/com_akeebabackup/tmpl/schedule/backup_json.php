<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

/** @var \Akeeba\Component\AkeebaBackup\Administrator\View\Schedule\HtmlView $this */

// Protect from unauthorized access
defined('_JEXEC') || die();

use Joomla\CMS\Language\Text;

?>
<div class="card mb-3">
	<h3 class="card-header">
		<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPIBACKUP') ?>
	</h3>

	<div class="card-body">
		<div class="alert alert-info">
			<p>
				<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPIBACKUP_INFO') ?>
			</p>
		</div>

		<?php if(!$this->croninfo->info->jsonapi): ?>
			<div class="alert alert-danger">
				<p>
					<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPI_DISABLED') ?>
				</p>
			</div>
		<?php elseif(!trim($this->croninfo->info->secret)): ?>
			<div class="alert alert-danger">
				<p>
					<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_FRONTEND_SECRET') ?>
				</p>
			</div>
		<?php else: ?>
			<p>
				<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPI_INTRO') ?>
			</p>

			<table class="table table-striped">
				<tbody>
				<tr>
					<td>
						<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPI_ENDPOINT')?>
					</td>
					<td>
						<?= $this->escape($this->croninfo->info->root_url )?>/<?= $this->escape($this->croninfo->json->path) ?>
					</td>
				</tr>
				<tr>
					<td>
						<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPI_SECRET') ?>
					</td>
					<td>
						<?= $this->escape($this->croninfo->info->secret) ?>
					</td>
				</tr>
				</tbody>
			</table>

			<p>
				<small>
					<?= Text::_('COM_AKEEBABACKUP_SCHEDULE_LBL_JSONAPI_DISCLAIMER') ?>
				</small>
			</p>
		<?php endif ?>
	</div>
</div>