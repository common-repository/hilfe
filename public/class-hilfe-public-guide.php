<?php

/**
 * The public-guide-specific functionality of the plugin.
 *
 * @package    HILFE
 * @subpackage HILFE/public
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Public_Guide extends HILFE_Public_Base
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $hilfe    The ID of this plugin.
     */
    private $hilfe;

    /**
     * Model Guide
     *
     * @since    1.0.0
     * @access   private
     */
    private $guideModel;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $hilfe       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($hilfe)
    {
        $this->hilfe      = $hilfe;
        $this->guideModel = new HILFE_Model_Guide();
    }

    /**
     * HILFE renderPopupGuide template.
     * @return [type] [description]
     */
    public function wp_footer()
    {
        $data = $this->guideModel->getAll();
        if (
            empty($data['is_show'])
            || empty($data['services'])
        ) {
            return;
        }

        $mini_title       = $data['mini_title'];
        $mini_description = $data['mini_description'];
        $show_title       = $data['show_title'];
        $show_description = $data['show_description'];
        $services         = $data['services'];
?>
        <!-- START HILFE GUIDE MINI -->
        <button id="hilfe-guide-mini" class="hilfe-guide-mini-wrap" onClick="hilfeGuideShow()" style="
            <?php
            if (!empty($data['background_color'])) {
                $background_color = $data['background_color'];
                echo ("background-color:" . esc_attr($background_color) . ";");
            }
            ?>
            <?php
            if (!empty($data['space_vertical'])) {
                $space_vertical = $data['space_vertical'];
                echo ("bottom:" . esc_attr($space_vertical) . 'px !important;' . ";");
            }
            ?>
            <?php
            if (!empty($data['position']) && !empty($data['space_horizon'])) {
                $position      = $data['position'];
                $space_horizon = $data['space_horizon'];
                if ($position == 'left') {
                    echo ('right: initial !important;');
                    echo ('left:' . esc_attr($space_horizon) . 'px !important;' . ";");
                }
                if ($position == 'right') {
                    echo ('left: initial !important;');
                    echo ('right:' . esc_attr($space_horizon) . 'px !important;' . ";");
                }
            }
            ?>
        ">
            <h3><?php echo (esc_html($mini_title)) ?></h3>
            <span><?php echo (esc_html($mini_description)) ?></span>
        </button>
        <!-- END HILFE GUIDE MINI -->

        <!-- START HILFE GUIDE SHOW-->
        <div id="hilfe-guide-show" class="hilfe-guide-show-wrap hilfe-d-none" style="
            <?php
            if (!empty($data['background_color'])) {
                $background_color = $data['background_color'];
                echo ("background-color:" . esc_attr($background_color) . ";");
            }
            ?>
            <?php
            if (!empty($data['space_vertical'])) {
                $space_vertical = $data['space_vertical'];
                echo ("bottom:" . esc_attr($space_vertical) . 'px !important;' . ";");
            }
            ?>
            <?php
            if (!empty($data['position']) && !empty($data['space_horizon'])) {
                $position      = $data['position'];
                $space_horizon = $data['space_horizon'];
                if ($position == 'left') {
                    echo ('right: initial !important;');
                    echo ('left:' . esc_attr($space_horizon) . 'px !important;' . ";");
                }
                if ($position == 'right') {
                    echo ('left: initial !important;');
                    echo ('right:' . esc_attr($space_horizon) . 'px !important;' . ";");
                }
            }
            ?>
        "> <!-- Start show-->

            <div id="hilfe-guide-show-close" class="hilfe-guide-show-close-button" onClick="hilfeGuideClose()"> <!-- Start close-->
                <img src="<?php echo (HILFE_ASSETS_URL) ?>/images/icon/xmark.svg" alt="close button">
            </div> <!-- End close-->

            <div class="hilfe-guide-show-title"> <!-- Start title-->
                <h3><?php echo (esc_html($show_title)) ?></h3>
                <span><?php echo (esc_html($show_description)) ?></span>
            </div> <!-- End title-->

            <ul class="hilfe-guide-screen-1" id="hilfe-guide-screen-1">
                <?php foreach ($services as $service) {
                    if (empty($service['is_show'])) {
                        continue;
                    }
                    ?>
                    <li onClick="hilfeGuideShowScreen2('screen_2_<?php echo $service['code'] ?>')">
                        <div class="hilfe-guide-screen-1-content">
                            <div class="hilfe-guide-screen-1-title">
                                <img class="hilfe-guide-screen-1-logo" src="<?php echo (esc_url($service['logo'])) ?>" alt="logo">
                                <div><?php echo (esc_html($service['name'])) ?></div>
                            </div>
                            <div class="hilfe-guide-screen-1-description"><?php echo (esc_html($service['description'])) ?></div>
                        </div>
                        <button class="hilfe-button-go-detail"><img src="<?php echo (HILFE_ASSETS_URL) ?>/images/icon/chevron-right.svg" alt="button detail" /></button>
                    </li>
                <?php } ?>
            </ul>
            <div class="hilfe-guide-screen-2">
                <?php foreach ($services as $service) { ?>
                    <div class="hilfe-guide-screen-2-content hilfe-d-none" id="screen_2_<?php echo $service['code'] ?>">
                        <div class="hilfe-guide-screen-2-title-wrap">
                            <div class="hilfe-guide-screen-2-title">
                                <button class="hilfe-button-back-screen-1" onclick="hilfeGuideShowScreen1()"><img src="<?php echo (HILFE_ASSETS_URL) ?>/images/icon/chevron-right.svg" alt="button detail" /></button>
                                <img class="hilfe-guide-screen-1-logo" src="<?php echo (esc_url($service['logo'])) ?>" alt="logo">
                                <div><?php echo (esc_html($service['name'])) ?></div>
                            </div>
                            <div class="hilfe-guide-screen-2-description"><?php echo (esc_html($service['description'])) ?></div>
                        </div>
                        <div class="hilfe-guide-screen-2-app">
                            <?php foreach ($service['apps'] as $app) { ?>
                                <div class="hilfe-guide-screen-2-app-content">

                                    <?php if (!empty($app['icon'] || $app['label'])) { ?>
                                        <div class="hilfe-guide-screen-2-app-title">
                                            <?php if (!empty($app['icon'])) { ?>
                                                <img src="<?php echo (esc_url($app['icon'])) ?>" alt="icon">
                                            <?php } ?>
                                            <div><?php echo (esc_html($app['label'])) ?></div>
                                        </div>
                                    <?php } ?>

                                    <div class="hilfe-guide-screen-2-app-download">
                                        <?php if (!empty($app['ios'])) { ?>
                                            <a href="<?php echo (esc_url($app['ios'])) ?>" target="_blank">
                                                <img src="<?php echo (HILFE_ASSETS_URL) ?>/images/icon/appstore.svg" alt="apple">
                                            </a>
                                        <?php } ?>
                                        <?php if (!empty($app['android'])) { ?>
                                            <a href="<?php echo (esc_url($app['android'])) ?>" target="_blank">
                                                <img src="<?php echo (HILFE_ASSETS_URL) ?>/images/icon/googleplay.svg" alt="android">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div> <!-- End show-->
        <!-- END HILFE GUIDE SHOW-->
<?php }
}
