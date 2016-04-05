<?php

/**
 * Base class for component responsible for installation and deinstallation
 * of this plugin.
 */

namespace Basis\Control\Installation;

use Basis\Control\AbstractController;

/**
 * Base class for component responsible for installation and deinstallation
 * of this plugin.
 * 
 * @package Basis
 * @subpackage Control\Installation
 */
abstract class AbstractInstaller extends AbstractController implements InstallerInterface {

	/**
	 * Do the actual uninstallation of this plugin.
	 *
	 *
	 * @note This method is called after verifying authority to uninstall.
	 */
	abstract protected function uninstall_plugin();

	/**
	 * Hook this component's callback functions to WordPress actions and filters.
	 *
	 * @see ComponentInterface::register_callbacks()
	 */
	public function register_callbacks() {

		parent::register_callbacks();
		
		register_uninstall_hook( $this->get_plugin_file(), array( get_called_class(), 'uninstall' ) );
		
		return $this;
	}

	/**
	 * Clear out any rewrite rules added by the plugin, options and/or
	 * settings specific to to the plugin, other database values that
	 * need to be removed, etc.
	 */
	public static function uninstall() {
		
		if ( is_admin() && current_user_can( 'delete_plugins' ) ) {
			static::get_instance()->uninstall_plugin();
		}
	}

}

?>