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
	 * Tell this component what plugin it is a part of.
	 * 
	 * @param string $plugin_file path to main plugin file
	 * 
	 * @return $this
	 */
	public function set_plugin_file( $plugin_file );
	
	/**
	 * Hook this component's callback functions to WordPress actions and filters.
	 * 
	 * @param $plugin_file path to main plugin file
	 * 
	 * @return $this
	 */
	public function register_callbacks();
	
	/**
	 * Load resources used by this component.
	 * 
	 * @return $this
	 */
	public function load_resources();
	
	/**
	 * Perform this component's function.
	 * 
	 * @return $this
	 */
	public function run();
	
	/**
	 * Get the name of the main plugin file for the plugin of which
	 * this component is a part.
	 *
	 * @return string
	 */
	public function get_plugin_file();
}

?>