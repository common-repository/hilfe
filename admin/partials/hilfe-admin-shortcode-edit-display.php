    <?php

/**
 * Provide a admin shortcode area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<!-- Start wrap -->
<div class="hilfe__wrap">
    <!-- Start loading -->
    <!-- <div id="hilfeOverlay" onclick="hilfeCloseOverlay()"></div>
  <div id="hilfeLoading">Loading...</div> -->
    <!-- End loading -->

    <!-- Start get data -->
    <?php
    $detail = $this->getShortcodeDetail();
    ?>
    <!-- End get data -->

    <!-- Start tittle -->
    <div class="hilfe-title">
        <h2><?php echo(__('Shortcode edit', 'hilfe')) ?></h2>
        <a href="<?php echo(admin_url('admin.php?page=hilfe-shortcode')) ?>" title="Back shortcode management">
            <?php echo(__('Back to shortcode management', 'hilfe')) ?>
        </a>
    </div>
    <!-- End tittle -->

    <!-- Start notify -->
    <?php $this->notifyUpdate(); ?>
    <!-- End notify -->
    <!-- Start form -->
    <form method="POST" action="">
        <div class="hilfe-row hilfe-shortcode-edit-form-body">
            <div class="hilfe-col-lg-6">
                <!-- Start hidden value -->
                <input type="hidden" name="code" value="<?php echo(esc_attr($detail['code'])) ?>" required>
                <input type="hidden" name="name" value="<?php echo(esc_attr($detail['name'])) ?>" required>
                <!-- End hidden value -->
                <!-- Start Service name -->
                <div class="hilfe-input-wrap">
                    <label for="name"><?php echo(__('Service name', 'hilfe')) ?></label>
                    <input type="text" name="name" disabled value="<?php echo(esc_attr($detail['name'])) ?>" class="hilfe-w-50" required>
                </div>
                <!-- End Service name -->
                <!-- Start Service code -->
                <div class="hilfe-input-wrap">
                    <label for="code"><?php echo(__('Service code', 'hilfe')) ?></label>
                    <input type="text" name="code" disabled value="<?php echo(esc_attr($detail['code'])) ?>" class="hilfe-w-50" required>
                </div>
                <!-- End Service code -->
                <!-- Start Link -->
                <div class="hilfe-input-wrap">
                    <label for="link"><?php echo(__('Link', 'hilfe')) ?></label>
                    <input type="text" name="link" value="<?php echo(esc_attr($detail['link'])) ?>" class="hilfe-w-50" required>
                </div>
                <!-- End Link -->
            </div>
            <div class="hilfe-col-lg-6">
                <!-- Start upload banner -->
                <div class="hilfe-shortcode-edit-upload">
                    <label><?php echo(__('Banner', 'hilfe')) ?></label>
                    <a target="_blank" href="<?php echo(esc_attr($detail['banner'])) ?>" title="<?php echo(esc_attr($detail['code'])) ?>">
                        <img id="hilfeShortcodeUploadImageView" src="<?php echo(esc_attr($detail['banner'])) ?>" alt="<?php echo(esc_attr($detail['code'])) ?>">
                    </a>
                    <input id="hilfeShortcodeUploadImageButton" class="button" type="button" value="<?php echo(__('Upload Image', 'hilfe')) ?>" />
                    <input id="hilfeShortcodeUploadImageText" name="banner" type="hidden" value="<?php echo(esc_attr($detail['banner'])) ?>" />
                </div>
                <!-- End upload banner -->
            </div>
        </div>
        <!-- Start Button -->
        <button type="submit" class="hilfe-btn hilfe-btn-primary">
            <?php echo(__('Update', 'hilfe')) ?>
        </button>
        <!-- End Button -->
        <?php wp_nonce_field($this->csrfKey, $this->csrfKey); ?>
    </form>
    <!-- End form -->
</div>
<!-- End wrap -->

<script>
    document.title = "<?php echo(__('Shortcode edit', 'hilfe')) ?>";

    var custom_uploader;

    jQuery('#hilfeShortcodeUploadImageButton').click(function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: "<?php echo(__('Choose new banner', 'hilfe')) ?>",
            button: {
                text: "<?php echo(__('Choose Image', 'hilfe')) ?>",
            },
            // multiple: true
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            let data = custom_uploader.state().get('selection').toJSON();
            let url = data[0].url;
            // console.log("custom_uploader: ", data);
            // console.log("url: ", data[0].url);

            // update input form
            const bannerInput = document.getElementById('hilfeShortcodeUploadImageText');
            // console.log("bannerInput: ", bannerInput)
            bannerInput.value = url;

            // update image view
            const bannerView = document.getElementById('hilfeShortcodeUploadImageView');
            // console.log("bannerView: ", bannerView)
            bannerView.src = url;

        });

        //Open the uploader dialog
        custom_uploader.open();
    });
</script>