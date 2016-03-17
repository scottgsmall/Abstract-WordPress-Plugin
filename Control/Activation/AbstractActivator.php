<?php

namespace Control\Activation;

use Library\Utility\Utility;

abstract class AbstractActivator implements ActivatorInterface {

	/**
	 * Do plugin-specific activation work (if any), other than activating classes.
	 */
	abstract protected function activate_plugin();

	/**
	 * Do all plugin-specific deactivation work, other than deactivating classes.
	 */
	abstract protected function deactivate_plugin();

	/**
	 * Verify that all other plugins required by this plugin are installed.
	 *
	 * @return true if all prerequisite plugins are installed, false if not
	 */
	abstract protected function check_prerequisite_plugins();

	/**
	 *
	 * @return array of classes (fully qualified class names) to be activated
	 *         when this plugin is activated
	 */
	abstract protected function get_activatable_classes();

	/**
	 * Fired during plugin activation.
	 *
	 * This method performs all actions necessary during the plugin's activation.
	 *
	 * @param bool $network_wide        	
	 */
	public function activate( $network_wide ) {

		if ( $network_wide && is_multisite() ) {
			$sites = wp_get_sites( array( 'limit' => false ) );
			
			foreach ( $sites as $site ) {
				switch_to_blog( $site ['blog_id'] );
				$this->single_activate( $network_wide );
				restore_current_blog();
			}
		} else {
			$this->single_activate( $network_wide );
		}
	}

	/**
	 * Fired during plugin deactivation.
	 *
	 * This method performs all actions necessary during the plugin's deactivation.
	 */
	public function deactivate() {

		if ( ! current_user_can( 'activate_plugins' ) ) {
			$this->deactivate_classes();
			$this->deactivate_plugin();
			flush_rewrite_rules();
		}
	}

	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @mvc Controller
	 *
	 * @param int $blog_id        	
	 */
	public function activate_new_site( $blog_id ) {

		switch_to_blog( $blog_id );
		$this->single_activate( true );
		restore_current_blog();
	}

	/**
	 * Prepares a single site to use the plugin
	 *
	 * @param bool $network_wide        	
	 */
	protected function single_activate( $network_wide ) {

		if ( current_user_can( 'activate_plugins' ) && $this->check_prerequisite_plugins() ) {
			$this->activate_classes( $network_wide );
			flush_rewrite_rules();
		}
	}

	private function activate_classes( $network_wide ) {

		foreach ( $this->get_activatable_classes() as $class ) {
			assert( Utility::class_implements_interface( $class, ActivatableInterface::class ) );
			$class::get_instance()->activate( $network_wide );
		}
	}

	private function deactivate_classes() {

		foreach ( $this->get_activatable_classes() as $class ) {
			assert( Utility::class_implements_interface( $class, ActivatableInterface::class ) );
			$class::get_instance()->deactivate();
		}
	}

}

?>