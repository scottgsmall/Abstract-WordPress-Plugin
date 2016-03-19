<?php

namespace Control\Activation;

use View\AdminViewInterface;
use View\AbstractAdminView;

/**
 * Base class for master activator class that activates all the other
 * activatable classes in the plugin.
 */
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
	 * Specify other plugins that must be installed before this one.
	 *
	 * @return array of the form ( plugin_name => plugin_directory_and_file ), e.g.
	 *         array( 'Abstract WordPress Plugin' => 'Abstract-WordPress-Plugin/abstract-wordpress-plugin.php' )
	 */
	abstract protected function get_prerequisite_plugins();

	/**
	 * Specify classes needing activation/deactivation.
	 *
	 * @note Specified classes must implement ActivatableInterface.
	 *
	 * @return array of classes (fully qualified class names) to be activated/deactivated
	 *         when this plugin is activated/deactivated.
	 */
	abstract protected function get_activatable_classes();

	/**
	 * Perform all actions necessary during the plugin's activation.
	 *
	 * @param bool $network_wide        	
	 */
	public function activate( $network_wide ) {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
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
	}

	/**
	 * Perform all actions necessary during the plugin's deactivation.
	 */
	public function deactivate() {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
			$this->deactivate_classes();
			$this->deactivate_plugin();
			flush_rewrite_rules();
		}
	}

	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @param int $blog_id        	
	 */
	public function activate_new_site( $blog_id ) {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
			switch_to_blog( $blog_id );
			$this->single_activate( true );
			restore_current_blog();
		}
	}

	/**
	 * Prepares a single site to use the plugin
	 *
	 * @param bool $network_wide        	
	 */
	private function single_activate( $network_wide ) {

		if ( ! self::have_prerequisite_plugins() ) {
			// abort activation of this plugin on current site
			deactivate_plugins( plugin_basename( __FILE__ ) );
			if ( isset( $_GET ['activate'] ) ) {
				unset( $_GET ['activate'] );
			}
		} else {
			// activate this plugin on current site
			$this->activate_classes( $network_wide );
			$this->activate_plugin();
			flush_rewrite_rules();
		}
	}

	private static function have_prerequisite_plugins() {

		$have_prerequisites = true;
		
		foreach ( self::get_prerequisite_plugins() as $plugin_name => $plugin_directory_and_file ) {
			if ( ! is_plugin_active( $plugin_directory_and_file ) ) {
				$have_prerequisites = false;
				$message = "This plugin requires the plugin $plugin_name ($plugin_directory_and_file) to be installed and active";
				$message_type = AdminViewInterface::MESSAGE_TYPE_ERROR;
				AbstractAdminView::admin_notice( $message, $message_type );
			}
		}
		
		return $have_prerequisites;
	}

	private function activate_classes( $network_wide ) {

		foreach ( $this->get_activatable_classes() as $class ) {
			$class::get_instance()->activate( $network_wide );
		}
	}

	private function deactivate_classes() {

		foreach ( $this->get_activatable_classes() as $class ) {
			$class::get_instance()->deactivate();
		}
	}

	private $missing_plugins;

}

?>