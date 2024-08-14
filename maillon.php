<?php

namespace Feuerpanda\Maillon;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://feuerpanda.de
 * @since             1.0.0
 * @package           Maillon
 *
 * @wordpress-plugin
 * Plugin Name:       Maillon
 * Plugin URI:        https://feuerpanda.de
 * Description:       Extends WordPress with some useful features for sending emails. Adds the option to set up SMTP data via constants and to test mail delivery.
 * Version:           1.0.0
 * Author:            Feuerpanda
 * Author URI:        https://feuerpanda.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       maillon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAILLON_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/Activator.php
 */
function activate_maillon() {
	Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/Deactivator.php
 */
function deactivate_maillon() {
	Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_maillon' );
register_deactivation_hook( __FILE__, 'deactivate_maillon' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_maillon() {

	$plugin = new Maillon();
	$plugin->run();

}
run_maillon();
