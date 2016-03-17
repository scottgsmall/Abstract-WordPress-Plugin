<?php

namespace Control\Activation;

abstract class AbstractActivator implements ActivatableInterface {

	/**
	 * Specifies the classes (if any) that require static activation 
	 * and deactivation.
	 * 
	 * @return array of classes (fully qualified class names) requiring static
	 *         activation and deactivation.
	 */
	abstract protected static function get_activatable_classes();

	/**
	 * Do plugin-specific activation work (if any), other than activating classes.
	 */
	abstract protected static function activate_plugin();

	/**
	 * Do all plugin-specific deactivation work, other than deactivating classes.
	 */
	abstract protected static function deactivate_plugin();

	/**
	 * Fired during plugin activation.
	 *
	 * This method performs all actions necessary during the plugin's activation.
	 */
	public static function activate() {

		if ( ! current_user_can( 'activate_plugins' ) )
			return;
		
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );
		
		self::activate_classes();
		self::activate_plugin();
	}

	/**
	 * Fired during plugin deactivation.
	 *
	 * This method performs all actions necessary during the plugin's deactivation.
	 */
	public static function deactivate() {

		self::deactivate_classes();
		self::deactivate_plugin();
	}

	private static function activate_classes() {

		foreach ( self::get_activatable_classes() as $class ) {
			$class::activate();
		}
	}

	private static function deactivate_classes() {

		foreach ( self::get_activatable_classes() as $class ) {
			$class::deactivate();
		}
	}

}

?>