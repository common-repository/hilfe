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
    <div id="hilfeOverlay" onclick="hilfeCloseOverlay()" class="hilfe-d-none"></div>
    <div id="hilfeLoading" class="hilfe-d-none"><?php echo(__('Loading...', 'hilfe')) ?></div>
    <!-- End loading -->

    <!-- Start get data -->
    <?php
    $configs = $this->shortCodeModel->getAll();
    ?>
    <!-- End get data -->

    <!-- Start tittle -->
    <div class="hilfe-title">
        <h2><?php echo(__('Shortcode Management', 'hilfe')) ?></h2>
        <div class="hilfe-tool">
            <button onClick="hilfeShortcodeReset()" class="hilfe-btn hilfe-btn-extra">
                <img src="<?php echo(HILFE_ASSETS_URL . "/images/icon/database.svg") ?>" alt="copy" />
                <?php echo(__('Reset Data', 'hilfe')) ?>
            </button>
        </div>
    </div>
    <!-- End tittle -->

    <!-- Start data table -->
    <table class="wp-list-table widefat fixed striped table-view-list pages hilfeShortcode__table">
        <!-- Start table head -->
        <thead>
            <tr>
                <th class="hilfeShortcode__table-head--name"><?php echo(__('Service name', 'hilfe')) ?></th>
                <th class="hilfeShortcode__table-head--banner"><?php echo(__('Banner', 'hilfe')) ?></th>
                <th class="hilfeShortcode__table-head--link"><?php echo(__('Link', 'hilfe')) ?></th>
                <th class="hilfeShortcode__table-head--shortcode"><?php echo(__('Shortcode', 'hilfe')) ?></th>
                <th class="hilfeShortcode__table-head--tool"><?php echo(__('Tool', 'hilfe')) ?></th>
            </tr>
        </thead>
        <!-- End table body -->
        <!-- Start table body -->
        <tbody>
            <?php foreach ($configs as $key => $config) { ?>
                <tr class="">
                    <!-- Start name -->
                    <td class=""><?php echo(esc_html($config['name'])) ?></td>
                    <!-- End name -->
                    <!-- Start banner -->
                    <td class="">
                        <div class="hilfeShortcode__table-body--banner">
                            <a href="<?php echo(esc_attr($config['banner'])) ?>" target="_blank" title="<?php echo(esc_attr($config['name'])) ?>">
                                <img src="<?php echo(esc_attr($config['banner'])) ?>" alt="<?php echo(esc_attr($config['name'])) ?>">
                            </a>
                        </div>
                    </td>
                    <!-- End banner -->
                    <!-- Start link -->
                    <td class="">
                        <a href="<?php echo(esc_attr($config['link'])) ?>" target="_blank" title="<?php echo(esc_attr($config['name'])) ?>">
                            <?php echo(esc_html($config['link'])) ?>
                        </a>
                    </td>
                    <!-- End link -->
                    <!-- Start shortcode -->
                    <td class="" id="hilfeShortcode__<?php echo(esc_attr($config['code'])) ?>">[hilfe_shortcode code="<?php echo(esc_attr($config['code'])) ?>"]</td>
                    <!-- End shortcode -->
                    <!-- Start tool -->
                    <td class="">
                        <a href="admin.php?page=hilfe-shortcode-edit&code=<?php echo(esc_attr($config['code'])) ?>">
                            <button class="hilfe-btn hilfe-btn-primary">
                                <img src="<?php echo(HILFE_ASSETS_URL . "/images/icon/pen-to-square.svg") ?>" alt="copy" />
                                <?php echo(__('Edit', 'hilfe')) ?>
                            </button>
                        </a>
                    </td>
                    <!-- End tool -->
                </tr>
            <?php } ?>
        </tbody>
        <!-- End table body -->
    </table>
    <!-- End data table -->
</div>
<!-- End wrap -->

<script>
    function hilfeShortcodeReset() {
        if (!confirm('<?php echo(__('Are you want to reset data default', 'hilfe')) ?>')) {
            return;
        }

        hilfeShowLoading();

        jQuery.ajax({
            url: "/wp-json/hilfe/api/shortcode/reset-data-default",
            method: "POST",
            data: JSON.stringify({}),
            success: function(res) {
                // console.log("success: ", res);
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            },
            error: function(err) {
                // console.log("error: ", err);
            },
        });
    }
</script>
