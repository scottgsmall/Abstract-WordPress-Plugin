<?php

/**
 * Base class for activator component responsible for actions related
 * to activation/deactivation of this plugin.
 */
namespace Basis\Control\Activation;

use Basis\Control\AbstractController;

/**
 * Base class for activator component responsible for actions related
 * to activation/deactivation of this plugin.
 *
 * @package Basis
 * @subpackage Control\Activation
 */
abstract class AbstractActivator extends AbstractController implements ActivatorInterface {

	/**
	 * Indicated whether to log plugin activation and deactivation to WordPress error log.
	 *
	 * @var bool
	 */
	const DO_LOG_ACTIVATION = true;

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
	 * Hook this component's callback functions to WordPress actions and filters.
	 *
	 * @see \Basis\ComponentInterface::register_callbacks()
	 */
	public function register_callbacks( $plugin_file ) {

		parent::register_callbacks( $plugin_file );
		
		$class = get_called_class();
		
		register_activation_hook( $plugin_file, array( $class, 'activate' ) );
		register_deactivation_hook( $plugin_file, array( $class, 'deactivate' ) );
		
		return $this;
	}

	/**
	 * Prepare to use the plugin during single or network-wide activation.
	 *
	 * @see \Basis\Control\Activation\ActivatorInterface::activate()
	 */
	public static function activate( $network_wide ) {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
			$activator = static::get_instance();
			
			if ( self::DO_LOG_ACTIVATION ) {
				self::log_message( __METHOD__, 'Activating plugin ' . plugin_basename( $activator->get_plugin_file() ) );
			}
			
			if ( $network_wide && is_multisite() ) {
				$sites = wp_get_sites( array( 'limit' => false ) );
				foreach ( $sites as $site ) {
					switch_to_blog( $site ['blog_id'] );
					$activator->single_activate( $network_wide );
					restore_current_blog();
				}
			} else {
				$activator->single_activate( $network_wide );
			}
		}
	}

	/**
	 * Roll back activation procedures when de-activating the plugin.
	 */
	public static function deactivate() {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
			$activator = static::get_instance();
			
			if ( self::DO_LOG_ACTIVATION ) {
				self::log_message( __METHOD__, 'Dectivating plugin ' . plugin_basename( $activator->get_plugin_file() ) );
			}
			
			$activator->deactivate_classes();
			$activator->deactivate_plugin();
			
			flush_rewrite_rules();
		}
	}

	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @see \Basis\Control\Activation\ActivatorInterface::activate_new_site()
	 */
	public static function activate_new_site( $blog_id ) {

		if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
			switch_to_blog( $blog_id );
			static::get_instance()->single_activate( true );
			restore_current_blog();
		}
	}

	/**
	 * Prepares a single site to use the plugin
	 *
	 * @param bool $network_wide        	
	 */
	private function single_activate( $network_wide ) {

		$missing_plugins = $this->get_missing_plugins();
		
		if ( ! empty( $missing_plugins ) ) {
			// one or more plugin required by this one is missing - roll back activation of this plugin on current site
			$this_plugin = $this->get_plugin_file();
			$message = self::build_missing_plugins_message( $missing_plugins, $this_plugin );
			self::log_message( __METHOD__, $message );
			deactivate_plugins( plugin_basename( $this_plugin ) );
			exit( $message );
		} else {
			// activate this plugin on current site
			$this->activate_classes( $network_wide );
			$this->activate_plugin();
			flush_rewrite_rules();
		}
	}

	/**
	 * Determine which of the plugins required by this one, if any, are missing
	 * from the current site.
	 *
	 * @return array
	 */
	private function get_missing_plugins() {

		$missing_plugins = array();
		
		foreach ( $this->get_prerequisite_plugins() as $plugin_name => $plugin_directory_and_file ) {
			if ( ! is_plugin_active( $plugin_directory_and_file ) ) {
				$missing_plugins [] = "$plugin_name ($plugin_directory_and_file)";
			}
		}
		
		return $missing_plugins;
	}

	/**
	 * Construct a message describing the missing plugins.
	 *
	 * @param array $missing_plugins        	
	 * @param string $this_plugin        	
	 */
	private static function build_missing_plugins_message( $missing_plugins, $this_plugin ) {

		$plugin_quantifier = count( $missing_plugins ) > 1 ? 'plugins are' : 'plugin is';
		$message = "Failed to activate plugin $this_plugin because the following $plugin_quantifier missing: " . implode( ', ', $missing_plugins );
		return $message;
	}

	/**
	 * Activate the activatable classes contained in this plugin.
	 *
	 * @param bool $network_wide        	
	 */
	private function activate_classes( $network_wide ) {

		foreach ( $this->get_activatable_classes() as $class ) {
			$class::get_instance()->activate( $network_wide );
		}
	}

	/**
	 * Deactivate the activatable classes contained in this plugin.
	 *
	 * @param bool $network_wide        	
	 */
	private function deactivate_classes() {

		foreach ( $this->get_activatable_classes() as $class ) {
			$class::get_instance()->deactivate();
		}
	}

}

?>