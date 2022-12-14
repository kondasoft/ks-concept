<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;
use Joomla\Component\Finder\Site\Helper\RouteHelper;

$searchRoute = RouteHelper::getSearchRoute(null)
?>

<smart-search>
    <form
        id="smart-search-form"
        class="d-flex" 
        action="<?php echo Route::_($searchRoute); ?>" 
        method="get" 
        role="search"
        data-base-url="<?php echo JUri::base(true) ?>"
        data-search-route="index.php/search">
        <span class="icon-search icon-white" aria-hidden="true"></span>
        <input 
            class="form-control" 
            type="search" 
            name="q" 
            placeholder="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_INPUT_LABEL') ?>" 
            aria-label="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_INPUT_LABEL') ?>"
            autocomplete="off" 
            aria-expanded="false" 
            aria-owns="smart-search-list" 
            role="combobox">
        <span 
            class="visually-hidden" 
            role="status" 
            aria-live="assertive" 
            aria-atomic="true"
            data-text-init="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_RESULTS_INIT') ?>" 
            data-text-no-results="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_NO_RESULTS_FOUND') ?>" 
            data-text-one-result="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_ONE_RESULT_FOUND') ?>" 
            data-text-results-found="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_RESULTS_FOUND') ?>" 
            data-text-error="<?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_RESULTS_ERROR') ?>">
            <?php echo JText::_('TPL_KS_CONCEPT_SMART_SEARCH_RESULTS_INIT') ?>
        </span>
        <ul id="smart-search-list" class="dropdown-menu" role="listbox"></ul>
    </form>
</smart-search>