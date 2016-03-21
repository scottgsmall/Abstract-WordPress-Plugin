<?php

/**
 * Base class for primary plugin component.
 */

namespace Basis\Model\Plugin;

use Basis\Model\AbstractModel;

/**
 * Base class for primary plugin component.
 * 
 * @package Basis
 * @subpackage Model\Plugin
 */
abstract class AbstractPlugin extends AbstractModel implements PluginInterface {

	/**
	 * Specify the components of this plugin.
	 * 
	 * @return array of (singleton) instances of component classes.
	 */
	abstract protected function get_plugin_components();

	/**
	 * Hook this component's callback functions to WordPress actions and filters.
	 *
	 * @see ComponentInterface::register_callbacks()
	 */
	public function register_callbacks( $plugin_file ) {

		foreach ( $this->get_plugin_components() as $component ) {
			self::log_message( __METHOD__, "Registering callbacks for component class " . get_class($component) );
			$component->register_callbacks( $plugin_file );
		}
		
		return $this;
	}

	/**
	 * Load resources used by this component.
	 */
	public function load_resources() {

		foreach ( $this->get_plugin_components() as $component ) {
			self::log_message( __METHOD__, "Loading resources for component class " . get_class($component) );
			$component->load_resources();
		}
		
		return $this;
	}

	/**
	 * Perform this component's function.
	 */
	public function run() {

		foreach ( $this->get_plugin_components() as $component ) {
			self::log_message( __METHOD__, "Running component class " . get_class($component) );
			$component->run();
		}
		
		return $this;
	}

}

?>