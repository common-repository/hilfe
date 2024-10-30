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
    <div id="hilfeLoading" class="hilfe-d-none"><?php echo (__('Loading...', 'hilfe')) ?></div>
    <!-- End loading -->

    <!-- Start get data -->
    <?php
    $data = $this->guideModel->getAll();
    ?>
    <!-- End get data -->

    <!-- Start tittle -->
    <div class="hilfe-title">
        <h2><?php echo (__('Popup guide management', 'hilfe')) ?></h2>
        <div class="hilfe-tool">
            <button onClick="hilfeGuideReset()" class="hilfe-btn hilfe-btn-extra">
                <img src="<?php echo (HILFE_ASSETS_URL . "/images/icon/database.svg") ?>" alt="copy" />
                <?php echo (__('Reset data', 'hilfe')) ?>
            </button>
        </div>
    </div>
    <!-- End tittle -->

    <!-- Start notify -->
    <?php $this->notifyUpdate(); ?>
    <!-- End notify -->
    <!-- Start form -->
    <form method="POST" action="" class="hilfe-form">
        <!-- Start form block -->
        <div class="hilfe-form-block">
            <h3><?php echo (__('Custom UI', 'hilfe')) ?></h3>
            <div class="hilfe-row hilfe-guide-form-body">
                <!-- Start Space vertical -->
                <div class="hilfe-col hilfe-col-lg-3">
                    <div class="hilfe-input-wrap">
                        <label for="space_vertical"><?php echo (__('Space vertical', 'hilfe')) ?></label>
                        <input type="number" required name="space_vertical" value="<?php echo (esc_attr($data['space_vertical'])) ?>" class="hilfe-w-100">
                    </div>
                </div>
                <!-- End Space vertical -->
                <!-- Start Space horizon -->
                <div class="hilfe-col hilfe-col-lg-3">
                    <div class="hilfe-input-wrap">
                        <label for="space_horizon"><?php echo (__('Space horizon', 'hilfe')) ?></label>
                        <input type="number" required name="space_horizon" value="<?php echo (esc_attr($data['space_horizon'])) ?>" class="hilfe-w-100">
                    </div>
                </div>
                <!-- End Space horizon -->
                <!-- Start Position -->
                <div class="hilfe-col hilfe-col-lg-2">
                    <div class="hilfe-input-wrap">
                        <label for="name"><?php echo (__('Position', 'hilfe')) ?></label>
                        <select id="hilfe_bar" name="position">
                            <option value="left" <?php selected($data['position'], 'left'); ?>><?php echo (esc_html_e('Left', 'hilfe')); ?></option>
                            <option value="right" <?php selected($data['position'], 'right'); ?>><?php echo (esc_html_e('Right', 'hilfe')); ?></option>
                        </select>
                    </div>
                </div>
                <!-- End Position -->
                <!-- Start Background color -->
                <div class="hilfe-col hilfe-col-lg-2">
                    <div class="hilfe-input-wrap">
                        <label for="background_color"><?php echo (__('Background color', 'hilfe')) ?></label>
                        <input id="hilfe_color" required name="background_color" type="text" value="<?php echo (esc_attr($data['background_color'])); ?>" class="hilfe-color-picker" />
                    </div>
                </div>
                <!-- End Background color -->
                <!-- Start Background color -->
                <div class="hilfe-col hilfe-col-lg-2">
                    <div class="hilfe-input-wrap">
                        <label for="background_color"><?php echo (__('Is show guide', 'hilfe')) ?></label>
                        <input type="checkbox" name="is_show" value="<?php echo (esc_attr($data['is_show'])) ?>" <?php echo (esc_attr($data['is_show'])) ? 'checked' : '' ?>>
                    </div>
                </div>
                <!-- End Background color -->
            </div>
        </div>
        <!-- End form block -->

        <!-- Start form block -->
        <div class="hilfe-form-block">
            <h3><?php echo (__('Custom title', 'hilfe')) ?></h3>
            <!-- Start form body -->
            <div class="hilfe-guide-form-body">
                <div class="hilfe-row">
                    <div class="hilfe-col hilfe-col-lg-6">
                        <!-- Start Mini title -->
                        <div class="hilfe-input-wrap">
                            <label for="mini_title"><?php echo (__('Mini title', 'hilfe')) ?></label>
                            <input type="text" required name="mini_title" value="<?php echo (esc_attr($data['mini_title'])) ?>" class="hilfe-w-100">
                        </div>
                        <!-- End Mini title -->
                        <!-- Start Mini description -->
                        <div class="hilfe-input-wrap">
                            <label for="mini_description"><?php echo (__('Mini description', 'hilfe')) ?></label>
                            <input type="text" required name="mini_description" value="<?php echo (esc_attr($data['mini_description'])) ?>" class="hilfe-w-100">
                        </div>
                        <!-- End Mini description -->
                    </div>
                    <div class="hilfe-col hilfe-col-lg-6">
                        <!-- Start Show title -->
                        <div class="hilfe-input-wrap">
                            <label for="show_title"><?php echo (__('Show title', 'hilfe')) ?></label>
                            <input type="text" required name="show_title" value="<?php echo (esc_attr($data['show_title'])) ?>" class="hilfe-w-100">
                        </div>
                        <!-- End Show title -->
                        <!-- Start Show description -->
                        <div class="hilfe-input-wrap">
                            <label for="show_description"><?php echo (__('Show description', 'hilfe')) ?></label>
                            <input type="text" required name="show_description" value="<?php echo (esc_attr($data['show_description'])) ?>" class="hilfe-w-100">
                        </div>
                        <!-- End Show description -->
                    </div>
                </div>
            </div>
            <!-- End form body -->
        </div>
        <!-- End form block -->

        <?php foreach ($data['services'] as $key => $service) { ?>
            <input type="hidden" name="services[<?php echo (esc_attr($key)) ?>][code]" value="<?php echo (esc_attr($service['code'])) ?>">
            <input type="hidden" name="services[<?php echo (esc_attr($key)) ?>][logo]" value="<?php echo (esc_attr($service['logo'])) ?>">
            <!-- Start form block -->
            <div class="hilfe-form-block">
                <h3 class="hilfe-d-flex hilfe-align-center"><input type="checkbox" name="services[<?php echo (esc_attr($key)) ?>][is_show]" value="<?php echo (esc_attr($service['is_show'])) ?>" <?php echo (esc_attr($service['is_show'])) ? 'checked' : '' ?>>
                    <?php echo (esc_html($service['code'])) ?>
                    <img src="<?php echo esc_attr($service['logo']) ?>" style="height: 24px; margin: 0 0.5rem;" />
                </h3>
                <!-- Start form body -->
                <div class="hilfe-guide-form-body">
                    <div class="hilfe-row">
                        <div class="hilfe-col hilfe-col-lg-6">
                            <!-- Start name -->
                            <div class="hilfe-input-wrap">
                                <label for="<?php echo (esc_attr($service['code'])) ?>['name']"><?php echo (__('Service name', 'hilfe')) ?></label>
                                <input type="text" required name="services[<?php echo (esc_attr($key)) ?>][name]" value="<?php echo (esc_attr($service['name'])) ?>" class="hilfe-w-100">
                            </div>
                            <!-- End name -->
                        </div>
                        <div class="hilfe-col">
                            <!-- Start description -->
                            <div class="hilfe-input-wrap">
                                <label for="<?php echo (esc_attr($service['code'])) ?>['description']"><?php echo (__('Service description', 'hilfe')) ?></label>
                                <input type="text" required name="services[<?php echo (esc_attr($key)) ?>][description]" value="<?php echo (esc_attr($service['description'])) ?>" class="hilfe-w-100">
                            </div>
                            <!-- End description -->
                        </div>
                    </div>

                    <div class="hilfe-row hilfe-guide-app-wrap">
                        <?php foreach ($service['apps'] as $keyApp => $app) { ?>
                            <div class="hilfe-col hilfe-col-lg-6 hilfe-guide-app-item">
                                <div class="hilfe-row">
                                    <div class="hilfe-col">
                                        <!-- Start label -->
                                        <div class="hilfe-input-wrap">
                                            <label for="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][label]"><?php echo (__('Label', 'hilfe')) ?></label>
                                            <input type="hidden" name="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][index]" value="<?php echo (esc_attr($app['index'])) ?>" class="hilfe-w-100">
                                            <input type="text" name="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][label]" value="<?php echo (esc_attr($app['label'])) ?>" class="hilfe-w-100">
                                        </div>
                                        <!-- End label -->
                                        <!-- Start icon -->
                                        <div class="hilfe-input-wrap">
                                            <label for="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][icon]"><?php echo (__('Icon label', 'hilfe')) ?></label>
                                            <input type="text" name="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][icon]" value="<?php echo (esc_attr($app['icon'])) ?>" class="hilfe-w-100">
                                        </div>
                                        <!-- End icon -->
                                        <!-- Start ios -->
                                        <div class="hilfe-input-wrap">
                                            <label for="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][ios]"><?php echo (__('Link app ios', 'hilfe')) ?></label>
                                            <input type="text" required name="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][ios]" value="<?php echo (esc_attr($app['ios'])) ?>" class="hilfe-w-100">
                                        </div>
                                        <!-- End ios -->
                                        <!-- Start android -->
                                        <div class="hilfe-input-wrap">
                                            <label for="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][android]"><?php echo (__('Link app android', 'hilfe')) ?></label>
                                            <input type="text" required name="services[<?php echo (esc_attr($key)) ?>][apps][<?php echo (esc_attr($app['index'])) ?>][android]" value="<?php echo (esc_attr($app['android'])) ?>" class="hilfe-w-100">
                                        </div>
                                        <!-- End android -->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Start form body -->
            </div>
            <!-- End form block -->
        <?php } ?>
        <!-- Start Button -->
        <button type="submit" class="hilfe-btn hilfe-btn-primary">
            <?php echo (__('Update', 'hilfe')) ?>
        </button>
        <!-- End Button -->
        <?php wp_nonce_field($this->csrfKey, $this->csrfKey); ?>
    </form>
    <!-- End form -->
</div>
<!-- End wrap -->


<script>
    function hilfeGuideReset() {
        if (!confirm("<?php echo (__('Are you want to reset data default', 'hilfe')) ?>")) {
            return;
        }

        hilfeShowLoading();

        jQuery.ajax({
            url: "/wp-json/hilfe/api/guide/reset-data-default",
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