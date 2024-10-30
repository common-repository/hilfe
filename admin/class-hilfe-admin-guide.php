<?php

/**
 * The admin-guide-specific functionality of the plugin.
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Admin_Guide extends HILFE_Admin_Base
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
        $this->hilfe        = $hilfe;
        $this->guideModel   = new HILFE_Model_Guide();
        $this->pageSlug     = 'hilfe-guide';
        $this->menuPosition = 3;
        $this->capability   = "manage_options";
        $this->csrfKey      = "hilfe-guide-nonce";

        if (
            $_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_REQUEST['page'])
            && $_REQUEST['page'] == $this->pageSlug
        ) {
            $this->processUpdate();
        }
    }

    /**
     * Register admin settings menu.
     *
     * @since 1.0.0
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = $this->hilfe;
        $page_title  = __('Popup guide management', 'hilfe');
        $menu_title  = __('Popup guide', 'hilfe');
        $capability  = $this->capability;
        $menu_slug   = $this->pageSlug;
        $callback    = array($this, "getView");
        $position    = $this->menuPosition;
        add_submenu_page(
            $parent_slug,
            $page_title,
            $menu_title,
            $capability,
            $menu_slug,
            $callback,
            $position
        );
    }

    /**
     * html form setting.
     *
     * @return [type] [description]
     */
    public function getView()
    {
        require_once HILFE_PATH . 'admin/partials/hilfe-admin-guide-display.php';
    }


    /**
     * Saves settings.
     *
     * @since 1.0.0
     * @access private
     * @return void
     */
    private function processUpdate()
    {
        $notifyStatus  = "";
        $notifyMessage = "";
        $page          = "hilfe-guide";

        try {
            // Validate
            // Get data from $_POST
            $guide = array(
                'space_vertical'            => sanitize_text_field($_POST['space_vertical']),
                'space_horizon'             => sanitize_text_field($_POST['space_horizon']),
                'position'                  => sanitize_text_field($_POST['position']),
                'background_color'          => sanitize_text_field($_POST['background_color']),
                'mini_title'                => sanitize_text_field($_POST['mini_title']),
                'mini_description'          => sanitize_text_field($_POST['mini_description']),
                'show_title'                => sanitize_text_field($_POST['show_title']),
                'show_description'          => sanitize_text_field($_POST['show_description']),
                'show_title_for_user'       => sanitize_text_field($_POST['show_title_for_user']),
                'show_title_for_contractor' => sanitize_text_field($_POST['show_title_for_contractor']),
                'is_show'                   => isset($_POST['is_show']) ? true : false,
                'services'                  => []
            );

            $services = $_POST['services'];
            foreach ($services as $key => $service) {
                $guide['services'][$key] = array(
                    'code'        => $service['code'],
                    'is_show'     => (isset($service['is_show'])) ? true : false,
                    'name'        => sanitize_text_field($service['name']),
                    'description' => sanitize_text_field($service['description']),
                    'logo'        => sanitize_text_field($service['logo']),
                );
                $apps = $service['apps'];
                foreach ($apps as $app) {
                    $guide['services'][$key]['apps'][] = array(
                        'index'   => sanitize_text_field($app['index']),
                        'label'   => sanitize_text_field($app['label']),
                        'icon'    => sanitize_text_field($app['icon']),
                        'ios'     => sanitize_text_field($app['ios']),
                        'android' => sanitize_text_field($app['android']),
                    );
                }
            }

            // Validate guide data
            $this->validateGuide($guide);

            // send data update
            $this->guideModel->updateAll($guide);

            // add effect alert
            $notifyStatus  = "SUCCESS";
            $notifyMessage = __("Guide updated!", 'hilfe');
        } catch (Exception $error) {
            $notifyStatus  = "ERROR";
            $notifyMessage = $error->getMessage();
        } finally {
            $pararms = array(
                'status'  => $notifyStatus,
                'message' => $notifyMessage,
            );
            $this->create_alert($pararms);
            $this->redirectAdminSite($page);
        }
    }


    /**
     * Validate input of guide
     *
     * @param [array] $data
     * @return boolean
     */
    private function validateGuide($data)
    {
        if (empty($data['space_vertical'])) {
            throw new Exception(__("Space vertical can not empty", 'hilfe'));
        }
        $data['space_vertical'] = sanitize_text_field($data['space_vertical']);

        if (empty($data['space_horizon'])) {
            throw new Exception(__("Space horizon can not empty", 'hilfe'));
        }

        if (empty($data['position'])) {
            throw new Exception(__("Position can not empty", 'hilfe'));
        }

        if (empty($data['background_color'])) {
            throw new Exception(__("Background color can not empty", 'hilfe'));
        }

        if (empty($data['mini_title'])) {
            throw new Exception(__("Mini title can not empty", 'hilfe'));
        }

        if (empty($data['mini_description'])) {
            throw new Exception(__("Mini description can not empty", 'hilfe'));
        }

        if (empty($data['show_title'])) {
            throw new Exception(__("Show title can not empty", 'hilfe'));
        }

        if (empty($data['show_description'])) {
            throw new Exception(__("Show description can not empty", 'hilfe'));
        }

        if (empty($data['services'])) {
            throw new Exception(__("Services can not empty", 'hilfe'));
        }

        if (isset($data['is_show'])) {
            $data['is_show'] = true;
        }

        foreach ($data['services'] as $service) {
            if (empty($service['name'])) {
                throw new Exception(__("Service name can not empty", 'hilfe'));
            }

            if (empty($service['description'])) {
                throw new Exception(__("Service description can not empty", 'hilfe'));
            }

            if (empty($service['logo'])) {
                throw new Exception(__("Service logo can not empty", 'hilfe'));
            }

            if (empty($service['apps'])) {
                throw new Exception(__("Service apps can not empty", 'hilfe'));
            }

            foreach ($service['apps'] as $app) {
                if (empty($app['index'])) {
                    throw new Exception(__("App index can not empty", 'hilfe'));
                }

                // if (empty($app['label'])) {
                //     throw new Exception(__("App label can not empty", 'hilfe'));
                // }

                // if (empty($app['icon'])) {
                //     throw new Exception(__("App icon can not empty", 'hilfe'));
                // }

                if (empty($app['ios'])) {
                    throw new Exception(__("App ios can not empty", 'hilfe'));
                }

                if (empty($app['android'])) {
                    throw new Exception(__("App android can not empty", 'hilfe'));
                }
            }
        }
    }
}
