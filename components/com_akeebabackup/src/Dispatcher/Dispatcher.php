<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2022 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Site\Dispatcher;

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\Dispatcher\Dispatcher as BackendDispatcher;
use Exception;
use Joomla\CMS\Document\FactoryInterface;
use Joomla\CMS\Document\JsonDocument as JDocumentJSON;
use Joomla\CMS\Factory as JFactory;

class Dispatcher extends BackendDispatcher
{
	protected $defaultController = 'backup';

	protected function onAfterDispatch()
	{
		$view = $this->input->getCmd('view', $this->defaultController);

		if (ucfirst(strtolower($view)) === 'Api')
		{
			$this->fixJsonApiOutput();
		}
	}

	/**
	 * Make sure the JSON API always outputs a JSON document.
	 *
	 * This works even when you have enabled caching, Joomla's off-line mode or tried to use tmpl=component.
	 *
	 * @throws  Exception
	 */
	private function fixJsonApiOutput()
	{
		$format = $this->input->getCmd('format', 'html');

		if ($format == 'json')
		{
			return;
		}

		$app = JFactory::getApplication();

		// Disable caching, disable offline, force use of index.php
		$app->set('caching', 0);
		$app->set('offline', 0);
		$app->set('themeFile', 'index.php');

		/** @var FactoryInterface $documentFactory */
		$documentFactory = JFactory::getContainer()->get(FactoryInterface::class);
		/** @var JDocumentJSON $doc */
		$doc = $documentFactory->createDocument('json');

		$app->loadDocument($doc);

		if (property_exists(JFactory::class, 'document'))
		{
			JFactory::$document = $doc;
		}

		// Set a custom document name
		/** @var JDocumentJSON $document */
		$document = $this->app->getDocument();
		$document->setName('akeeba_backup');
	}
}