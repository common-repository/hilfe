<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    HILFE
 * @subpackage HILFE/admin
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Admin extends HILFE_Admin_Base
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
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string    $hilfe       The name of this plugin.
	 */
	public function __construct($hilfe, $version)
	{
		$this->hilfe       = $hilfe;
		$this->version      = $version;
		$this->menuPosition = 1;
		$this->capability   = "manage_options";
	}

	/**
	 * [add_action_links description]
	 * @param  [type] $links_array [description]
	 * @return [type]              [description]
	 */
	public function add_action_links($links)
	{
		$links[] = '<a href="' . admin_url('/admin.php?page=hilfe-dashboard') . '">' . esc_html__('Settings', 'hilfe') . '</a>';

		return array_merge($links);
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in HILFE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The HILFE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style(
			$this->hilfe,
			HILFE_URL . 'admin/css/hilfe-admin.css',
			array('wp-color-picker'),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in HILFE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The HILFE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_media();
		wp_enqueue_script(
			$this->hilfe,
			HILFE_URL . 'admin/js/hilfe-admin.js',
			array('jquery', 'wp-color-picker'),
			$this->version,
			true
		);
	}

	/**
	 * Register admin settings menu.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function admin_menu()
	{
		$page_title = __('HILFE AR', 'hilfe');
		$menu_title = __('HILFE AR', 'hilfe');
		$capability = $this->capability;
		$slug       = $this->hilfe;
		$callback   = false;
		$icon       = HILFE_ASSETS_URL . '/images/logo/logo20x20.png';

		add_menu_page(
			$page_title,
			$menu_title,
			$capability,
			$slug,
			$callback,
			$icon
		);
	}

	/**
	 * Delete admin menu item in submenu
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function hidden_admin_submenu()
	{
		remove_submenu_page(
			$this->hilfe,
			$this->hilfe
		);
	}
}
