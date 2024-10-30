<?php

/**
 * The admin-dashboard-specific functionality of the plugin.
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Admin_Dashboard extends HILFE_Admin_Base
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
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $hilfe       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($hilfe)
    {
        $this->hilfe       = $hilfe;
        $this->pageSlug     = 'hilfe-dashboard';
        $this->menuPosition = 2;
        $this->capability   = "manage_options";
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
        $page_title  = __('Dashboard', 'hilfe');
        $menu_title  = __('Dashboard', 'hilfe');
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
        require_once HILFE_PATH . 'admin/partials/hilfe-admin-dashboard-display.php';
    }
}
