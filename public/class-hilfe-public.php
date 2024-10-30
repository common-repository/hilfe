<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://fswa-net.com
 * @since      1.0.0
 *
 * @package    HILFE
 * @subpackage HILFE/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    HILFE
 * @subpackage HILFE/public
 * @author     FSWA-NET <wordpress-developer@fswa-net.com>
 */
class HILFE_Public
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
	 * @param      string    $hilfe       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($hilfe, $version)
	{
		$this->hilfe  = $hilfe;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
			plugin_dir_url(__FILE__) . 'css/hilfe-public.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script(
			$this->hilfe,
			plugin_dir_url(__FILE__) . 'js/hilfe-public.js',
			array('jquery'),
			$this->version,
			false
		);
	}
}
