<?php

/**
 * @package     KS Newsletter
 *
 * @copyright   (C) 2022 KondaSoft, Inc. <https://www.kondasoft.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;

?>

<script src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js' defer></script>
<script>
    window.addEventListener('DOMContentLoaded', () => {
        (function($) {
            window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';
        }(jQuery));
        var $mcj = jQuery.noConflict(true);
    })
</script>

<section
    id="ks-newsletter-<?php echo $module->id; ?>"
    class="
        ks-newsletter
        <?php echo 'pt-' . htmlspecialchars($params->get('padding_top', 11)) ?>
        <?php echo 'pb-' . htmlspecialchars($params->get('padding_bottom', 11)) ?>
        <?php echo 'mt-' . htmlspecialchars($params->get('margin_top', 0)) ?>
        <?php echo 'mb-' . htmlspecialchars($params->get('margin_bottom', 0)) ?>
    "
    style="background-color: <?php echo htmlspecialchars($params->get('bg_color', '#ffffff')) ?>">
    <div class="container">
        <div class="mx-auto" style="<?php echo 'max-width: ' . htmlspecialchars($params->get('max_width', '600')) . 'px' ?>">
            <?php if ($params->get('title_show', 1)) : ?>
                <h2 class="title text-center mb-3 <?php echo htmlspecialchars($params->get('title_size', 'h2')) ?>">
                    <?php echo htmlspecialchars($params->get('title', 'Accordion (F.A.Q)')); ?>
                </h2>
            <?php endif ?>
            <?php if ($params->get('description_show', 1)) : ?>
                <div class="description text-center mb-7 <?php echo htmlspecialchars($params->get('description_size', 'fs-6')) ?>">
                    <?php echo strip_tags($params->get('description', '<p>Be the first to know about our important stuff.</p>'), '<p><a><br><br/><strong>'); ?>
                </div>
            <?php endif ?>
            <!-- Begin Mailchimp Signup Form -->
            <div id="mc_embed_signup">
                <form 
                    id="mc-embedded-subscribe-form" 
                    class="validate" 
                    action="https://mailchimp.us18.list-manage.com/subscribe/post?u=<?php echo htmlspecialchars($params->get('mailchimp_user_id')); ?>&amp;id=<?php echo htmlspecialchars($params->get('mailchimp_audience_id')); ?>" 
                    method="post"
                    name="mc-embedded-subscribe-form"
                    target="_blank" 
                    novalidate>
                    <div id="mce-responses" class="">
                        <div id="mce-error-response" class="response alert alert-warning my-5" style="display:none" aria-live="polite" aria-atomic="true"></div>
                        <div id="mce-success-response" class="response alert alert-success my-5" style="display:none" aria-live="polite" aria-atomic="true"></div>
                    </div>
                    <div class="input-group input-group-lg mb-2">
                        <input
                            id="mce-EMAIL"
                            class="form-control required" 
                            type="email" 
                            value="" 
                            name="EMAIL"
                            label="<?php echo htmlspecialchars($params->get('mailchimp_email_label', 'Enter your email address')); ?>"
                            placeholder="<?php echo htmlspecialchars($params->get('mailchimp_email_label', 'Enter your email address')); ?>"
                            required>
                        <input 
                            id="mc-embedded-subscribe" 
                            class="button btn <?php echo htmlspecialchars($params->get('btn_color', 'btn-primary')) ?>" 
                            type="submit" 
                            name="subscribe" 
                            value="<?php echo htmlspecialchars($params->get('mailchimp_btn_label', 'Subscribe')); ?>">
                    </div>
                    <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_50abf627db9d7e7568667598e_777ff8e7af" tabindex="-1" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
