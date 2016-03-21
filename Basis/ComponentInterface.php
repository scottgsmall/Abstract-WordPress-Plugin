<?php

/**
 * Interface for components of this plugin.
 */

namespace Basis;

/**
 * Interface for components of this plugin. 
 * 
 * Components are classes containing major portions of this 
 * plugin's functionality, e.g. models, views, controllers, etc.
 * The lifecycle of a component, within the WordPress loop, consists
 * of registering callbacks, loading resources, and running. 
 * 
 * @package Basis
 */
interface ComponentInterface {

	/**
	 * Hook this component's callback functions to WordPress actions and filters.
	 * 
	 * @param $plugin_file path to main plugin file
	 */
	public function register_callbacks( $plugin_file );
	
	/**
	 * Load resources used by this component.
	 */
	public function load_resources();
	
	/**
	 * Perform this component's function.
	 */
	public function run();
}

?>