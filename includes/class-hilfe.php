<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    HILFE
 * @subpackage HILFE/includes
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      HILFE_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $hilfe    The string used to uniquely identify this plugin.
	 */
	protected $hilfe;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('HILFE_VERSION')) {
			$this->version = HILFE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->hilfe = 'hilfe';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_api_hooks();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - HILFE_Loader. Orchestrates the hooks of the plugin.
	 * - HILFE_i18n. Defines internationalization functionality.
	 * - HILFE_Admin. Defines all hooks for the admin area.
	 * - HILFE_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{
		/**************
		 * INCLUDES
		 **************/
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once HILFE_PATH . 'includes/class-hilfe-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once HILFE_PATH . 'includes/class-hilfe-i18n.php';

		/**************
		 * MODELS
		 **************/
		/**
		 * The class responsible for defining model base.
		 */
		require_once HILFE_PATH . 'model/class-hilfe-model-base.php';

		/**
		 * The class responsible for defining model shortcode.
		 */
		require_once HILFE_PATH . 'model/class-hilfe-model-shortcode.php';

		/**
		 * The class responsible for defining model guide.
		 */
		require_once HILFE_PATH . 'model/class-hilfe-model-guide.php';

		/**************
		 * API
		 **************/
		/**
		 * The class responsible for defining api base.
		 */
		require_once HILFE_PATH . 'api/class-hilfe-api-base.php';

		/**
		 * The class responsible for defining api shortcode.
		 */
		require_once HILFE_PATH . 'api/class-hilfe-api-shortcode.php';

		/**
		 * The class responsible for defining api guide.
		 */
		require_once HILFE_PATH . 'api/class-hilfe-api-guide.php';

		/**************
		 * ADMIN
		 **************/
		/**
		 * The class responsible for defining admin base.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin-base.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin dashboard area.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin-dashboard.php';

		/**
		 * The class responsible for defining all actions that occur in the admin shortcode area.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin-shortcode.php';

		/**
		 * The class responsible for defining all actions that occur in the admin shortcode edit area.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin-shortcode-edit.php';

		/**
		 * The class responsible for defining all actions that occur in the admin guide area.
		 */
		require_once HILFE_PATH . 'admin/class-hilfe-admin-guide.php';

		/**************
		 * PUBLICS
		 **************/
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once HILFE_PATH . 'public/class-hilfe-public.php';

		/**
		 * The class responsible for defining all actions that occur in the public base
		 */
		require_once HILFE_PATH . 'public/class-hilfe-public-base.php';

		/**
		 * The class responsible for defining all actions that occur in the public shortcode
		 */
		require_once HILFE_PATH . 'public/class-hilfe-public-shortcode.php';

		/**
		 * The class responsible for defining all actions that occur in the public guide
		 */
		require_once HILFE_PATH . 'public/class-hilfe-public-guide.php';

		$this->loader = new HILFE_Loader();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_api_hooks()
	{
		$plugin_api_guide     = new HILFE_API_GUIDE();
		$plugin_api_shortcode = new HILFE_API_Shortcode();

		$this->loader->add_action('rest_api_init', $plugin_api_guide, 'register_rest_route');
		$this->loader->add_action('rest_api_init', $plugin_api_shortcode, 'register_rest_route');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{
		$plugin_admin                = new HILFE_Admin($this->get_hilfe(), $this->get_version());
		$plugin_admin_dashboard      = new HILFE_Admin_Dashboard($this->get_hilfe());
		$plugin_admin_shortcode      = new HILFE_Admin_Shortcode($this->get_hilfe());
		$plugin_admin_shortcode_edit = new HILFE_Admin_Shortcode_Edit($this->get_hilfe());
		$plugin_admin_guide          = new HILFE_Admin_Guide($this->get_hilfe());

		$this->loader->add_filter('plugin_action_links_' . HILFE_BASE_NAME, $plugin_admin, 'add_action_links');

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $plugin_admin, 'admin_menu');
		$this->loader->add_action('admin_menu', $plugin_admin, 'hidden_admin_submenu', 999);
		$this->loader->add_action('admin_menu', $plugin_admin_dashboard, 'admin_menu');
		$this->loader->add_action('admin_menu', $plugin_admin_shortcode, 'admin_menu');
		$this->loader->add_action('admin_menu', $plugin_admin_shortcode_edit, 'admin_menu');
		$this->loader->add_action('admin_menu', $plugin_admin_guide, 'admin_menu');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public           = new HILFE_Public($this->get_hilfe(), $this->get_version());
		$plugin_public_shortcode = new HILFE_Public_Shortcode($this->get_hilfe());
		$plugin_public_guide     = new HILFE_Public_Guide($this->get_hilfe());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$this->loader->add_action('wp_footer', $plugin_public_guide, 'wp_footer');

		$this->loader->add_shortcode('hilfe_shortcode', $plugin_public_shortcode, 'render_shortcode');
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the HILFE_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new HILFE_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_hilfe()
	{
		return $this->hilfe;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    HILFE_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
