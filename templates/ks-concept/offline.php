<?php

/**
 * @package     KS Concept - Free Joomla Template
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\AuthenticationHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/** @var Joomla\CMS\Document\HtmlDocument $this */

require_once('templates/' . Factory::getApplication()->getTemplate() . '/includes/head.php');
?>
<!DOCTYPE html>
<html 
    lang="<?php echo $this->language; ?>" 
    dir="<?php echo $this->direction; ?>">

<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>
<body class="offline-page">
    <div class="container">
        <div class="container-inner">
            <div class="offline-page-header">
                <div class="mb-4 fs-1">
                    <?php require($template_path . '/includes/navbar-logo.php'); ?>
                </div>
                <?php if ($app->get('offline_image')) : ?>
                    <div class="mb-4">
                        <?php echo HTMLHelper::_('image', $app->get('offline_image'), $sitename, [], false, 0); ?>
                    </div>
                <?php endif; ?>
                <?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>
                    <p>
                        <?php echo $app->get('offline_message'); ?>
                    </p>
                <?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
                    <p>
                        <?php echo Text::_('JOFFLINE_MESSAGE'); ?>
                    </p>
                <?php endif; ?>
            </div>
            <div class="card">
                <h2 class="h5 card-header py-4">
                    <?php echo Text::_('JACTION_LOGIN_ADMIN'); ?>
                </h2>
                <div class="card-body">
                    <jdoc:include type="message" />
                    <form id="form-login" action="<?php echo Route::_('index.php', true); ?>" method="post">
                        <fieldset>
                            <div class="form-group mb-6">
                                <label 
                                    class="form-label"
                                    for="username">
                                    <?php echo Text::_('JGLOBAL_USERNAME'); ?>
                                </label>
                                <input 
                                    id="username" 
                                    class="form-control" 
                                    type="text"
                                    name="username">
                            </div>
                            
                            <div class="form-group mb-6">
                                <label 
                                    class="form-label"
                                    for="password">
                                    <?php echo Text::_('JGLOBAL_PASSWORD'); ?>
                                </label>
                                <input 
                                    id="password" 
                                    class="form-control" 
                                    name="password" 
                                    type="password">
                            </div>

                            <?php $extraButtons = AuthenticationHelper::getLoginButtons('form-login'); ?>
                            <?php foreach ($extraButtons as $button) :
                                $dataAttributeKeys = array_filter(array_keys($button), function ($key) {
                                    return substr($key, 0, 5) == 'data-';
                                });
                            ?>
                                <button 
                                    id="<?php echo $button['id'] ?>"
                                    class="btn btn-secondary w-100 mt-4 <?php echo $button['class'] ?? '' ?>"
                                    type="button"
                                    <?php foreach ($dataAttributeKeys as $key) : ?>
                                        <?php echo $key ?>="<?php echo $button[$key] ?>"
                                    <?php endforeach; ?>
                                    <?php if ($button['onclick']) : ?>
                                        onclick="<?php echo $button['onclick'] ?>"
                                    <?php endif; ?>
                                    title="<?php echo Text::_($button['label']) ?>"
                                >
                                    <?php if (!empty($button['icon'])) : ?>
                                        <span class="<?php echo $button['icon'] ?>"></span>
                                    <?php elseif (!empty($button['image'])) : ?>
                                        <?php echo $button['image']; ?>
                                    <?php elseif (!empty($button['svg'])) : ?>
                                        <?php echo $button['svg']; ?>
                                    <?php endif; ?>
                                    <?php echo Text::_($button['label']) ?>
                                </button>
                            <?php endforeach; ?>

                            <button 
                                class="btn btn-primary w-100"
                                type="submit" 
                                name="Submit">
                                <?php echo Text::_('JLOGIN'); ?>
                            </button>

                            <input type="hidden" name="option" value="com_users">
                            <input type="hidden" name="task" value="user.login">
                            <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>">
                            <?php echo HTMLHelper::_('form.token'); ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
