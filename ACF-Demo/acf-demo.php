<?php
/**
 * Plugin Name: Our ACF Demo
 * Plugin Uri: https://acf-demo
 * Description: 
 * Author: SeJan ahmed BayZid
 * Version: 1.0
 * License: 
 * Text Domain: acf-demo
 * Domain path: /languages
 */

require_once(plugin_dir_path(__FILE__) . "/lib/class-tgm-plugin-activation.php");
require_once(plugin_dir_path(__FILE__)."/inc/acf-metabox.php");

function acf_bootstrapping(){
    load_plugin_textdomain('acf-demo', false, dirname(__FILE__).'/languages');
}
 add_action('plugin_loaded', 'acf_bootstrapping');

 add_action( 'tgmpa_register', 'acf_demo_register_required_plugins' );


 function acf_demo_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(                         

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => dirname( __FILE__ ) . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Advanced Custom Field',
			'slug'      => 'advanced-custom-fields',
			'required'  => true,
		),		
        

		// array(
		// 	'name'        => 'WordPress SEO by Yoast',
		// 	'slug'        => 'wordpress-seo',
		// 	'is_callable' => 'wpseo_init',
		// ),

	);

	$config = array(
		'id'           => 'acf-demo',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		
	);

	tgmpa( $plugins, $config );
}

 /* to hide the framework from the admin dashboard */
add_filter('acf/settings/show_admin', '__return_false');