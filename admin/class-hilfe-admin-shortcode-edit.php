<?php

/**
 * The admin-shortcode-specific functionality of the plugin.
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Admin_Shortcode_Edit extends HILFE_Admin_Base
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
     * Shortcode model
     *
     * @since    1.0.0
     * @access   private
     */
    private $shortCodeModel;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $hilfe       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($hilfe)
    {
        $this->hilfe         = $hilfe;
        $this->shortCodeModel = new HILFE_Model_Shortcode();
        $this->pageSlug       = 'hilfe-shortcode-edit';
        $this->menuPosition   = 999;
        $this->capability     = "manage_options";
        $this->csrfKey        = "hilfe-shortcode-edit-nonce";

        // user action POST then run update function
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
        $parent_slug = ""; // hidden menu
        $page_title  = __('Shortcode Edit', 'hilfe');
        $menu_title  = __('Shortcode Edit', 'hilfe');
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
        require_once HILFE_PATH . 'admin/partials/hilfe-admin-shortcode-edit-display.php';
    }


    /**
     * Get shortcode detail
     *
     * @since 1.0.0
     */
    public function getShortcodeDetail()
    {
        $data = [];

        if (!isset($_GET['code'])) {
            $this->redirectAdminSite('hilfe-shortcode');
        }

        $code = sanitize_text_field($_GET['code']);

        try {
            $data = $this->shortCodeModel->getOneByCode($code);
        } catch (Exception $error) {
            $message = $error->getMessage();
            echo '<div class="error"><p>' . esc_html($message) . '</p></div>';
            return;
        }

        return $data;
    }


    /**
     * Handle update data
     *
     * @since 1.0.0
     */
    public function processUpdate()
    {
        $notifyStatus = "";
        $notifyMessage = "";
        $page = "hilfe-shortcode-edit";
        $code = "";

        try {
            // Get data from $_POST
            $shortcode = array(
                'code' => sanitize_text_field($_POST['code']),
                'name' => sanitize_text_field($_POST['name']),
                'link' => sanitize_text_field($_POST['link']),
                'banner' => sanitize_text_field($_POST['banner']),
            );
            $code = $shortcode['code'];

            // get all data in db
            $configs = $this->shortCodeModel->getAll();
            if (empty($configs)) {
                throw new Exception(__("Empty config", 'hilfe'));
            }

            // Validate shortcode data
            $this->validateShortcode($shortcode);

            // Update shortcode data in database
            $this->shortCodeModel->updateShortcode($configs, $shortcode);

            // Set success message
            $notifyStatus = "SUCCESS";
            $notifyMessage = __("Shortcode updated!", 'hilfe');
        } catch (Exception $error) {
            // Set error message
            $notifyStatus = "ERROR";
            $notifyMessage = $error->getMessage();
        } finally {
            // Set message
            $pararms = array(
                'status'  => $notifyStatus,
                'message' => $notifyMessage,
            );
            $this->create_alert($pararms);
            $this->redirectAdminSite($page, array('code' => $code));
        }
    }

    /**
     * Validate input of shortcode
     *
     * @param [array] $data
     * @return boolean
     */
    private function validateShortcode($data)
    {
        if (empty($data['code'])) {
            throw new Exception(__("Code can not empty", 'hilfe'));
        }

        if (empty($data['banner'])) {
            throw new Exception(__("Banner can not empty", 'hilfe'));
        }

        if (empty($data['link'])) {
            throw new Exception(__("Link can not empty", 'hilfe'));
        }

        if (!$this->validateURL($data['link'])) {
            throw new Exception(__("Invalid format link. Example: https://fswa-net.com", 'hilfe'));
        }
    }
}
