<?php

namespace Control\Activation;

abstract class AbstractActivator implements ActivatorInterface {

	/**
	 * @return array of classes (fully qualified class names) requiring static
	 *         activation and deactivation.
	 */
	abstract protected function get_activatable_classes();
	
	/**
	 * Fired during plugin activation.
	 *
	 * This class defines all code necessary to run during the plugin's activation.
	 *
	 * @since 1.0.0
	 */
	public static function activate() {
	
		foreach ( self::get_activatable_classes() as $class ) {
			$class::activate();
		}
	}
	
	/**
	 * Fired during plugin deactivation.
	 *
	 * This class defines all code necessary to run during the plugin's deactivation.
	 *
	 * @since 1.0.0
	 */
	public static function deactivate() {
	
		foreach ( self::get_activatable_classes() as $class ) {
			$class::deactivate();
		}
	}

}

?>