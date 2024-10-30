<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fswa-net.com
 * @since             1.0.0
 * @package           HILFE
 *
 * @wordpress-plugin
 * Plugin Name:       HILFE AR
 * Plugin URI:        https://fswa-net.com
 * Description:       HILFE AR plugin helps add more functions to banner and guidance editing , which will make it easier to manage a post of a wordpress site. 
 * Version:           1.0.0
 * Author:            FSWA-NET
 * Author URI:        https://fswa-net.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hilfe
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

/** WordPress Plugin Administration API */
// if (!function_exists('wp_redirect')) {
//   require_once(ABSPATH . 'wp-admin/includes/plugin.php');
// }

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define('HILFE_VERSION', '1.0.0');

/**************
 * CONSTANTS PATH
 **************/
define('HILFE_FILE', __FILE__);
define('HILFE_NAME', basename(HILFE_FILE));
define('HILFE_BASE_NAME', plugin_basename(HILFE_FILE));
define('HILFE_PATH', plugin_dir_path(HILFE_FILE));
define('HILFE_URL', plugin_dir_url(HILFE_FILE));
define('HILFE_ASSETS_URL', HILFE_URL . 'public');

/**************
 * CONSTANTS SERVICES
 **************/
define('HILFE_SERVICE_CAR_BOOKING', "CAR");
define('HILFE_SERVICE_ACCOMMODATION_BOOKING', "ACCOMMODATION");
define('HILFE_SERVICE_VENUE_BOOKING', "VENUE");
define('HILFE_SERVICE_HEARSE_BOOKING', "HEARSE");
define('HILFE_SERVICE_RESTING_PLACE_BOOKING', "RESTING_PLACE");
define('HILFE_SERVICE_HEARSE_AND_RESTING_PLACE_BOOKING', "HEARSE_AND_RESTING_PLACE");
define('HILFE_SERVICE_FULNERAL_HALL_BOOKING', "FULNERAL_HALL");
define('HILFE_SERVICE_RELIGIOUS_BOOKING', "RELIGIOUS");
define('HILFE_SERVICE_CEMETERY_BOOKING', "CEMETERY");

/**************
 * CONSTANTS APPS
 **************/
// define('HILFE_APP_AR_FNET', "APP_HILFE-AR_FNET");
// define('HILFE_APP_FUNERAL_FNET', "APP_HILFE_FNET");
define('HILFE_APP_SERVICE_HILFE', "HILFE_APP_SERVICE_HILFE");
define('HILFE_APP_SERVICE_HILFE_AR', "HILFE_APP_SERVICE_HILFE_AR");
define('HILFE_APP_SERVICE_HILFE_AI', "HILFE_APP_SERVICE_HILFE_AI");

/**************
 * CONSTANTS DB OPTIONS
 **************/
define('HILFE_SHORTCODE_OPTION', "hilfe_shortcode_options");
define('HILFE_GUIDE_OPTION', "hilfe_guide_options");

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hilfe-activator.php
 */
function activate_hilfe()
{
  require_once HILFE_PATH . 'includes/class-hilfe-activator.php';
  HILFE_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hilfe-deactivator.php
 */
function deactivate_hilfe()
{
  require_once HILFE_PATH . 'includes/class-hilfe-deactivator.php';
  HILFE_Deactivator::deactivate();
}

register_activation_hook(HILFE_FILE, 'activate_hilfe');
register_deactivation_hook(HILFE_FILE, 'deactivate_hilfe');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require HILFE_PATH . 'includes/class-hilfe.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hilfe()
{
  $plugin = new HILFE();
  $plugin->run();
}
run_hilfe();
