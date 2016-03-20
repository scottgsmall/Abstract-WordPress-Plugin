<?php

namespace Basis\Control\Installation;

use Basis\Control\AbstractController;
/**
 * Base class for class responsible for installation and deinstallation
 * of this plugin.
 */
abstract class AbstractInstaller extends AbstractController implements InstallerInterface {
	
	/**
	 * Do the actual uninstallation of this plugin. 
	 * 
	 * @note This method is called after verifying authority to uninstall.
	 */
	abstract protected function uninstall_plugin();
	
	public function register_callbacks() {
	
		parent::register_callbacks();
	
		register_uninstall_hook( __FILE__, array( $this, 'uninstall' ) );
	
		return $this;
	}

	public function uninstall() {

		// Verify authority to uninstall this plugin
		if ( is_admin() && current_user_can( 'delete_plugins' ) ) {
			check_admin_referer( 'bulk-plugins' );
			
			// Important: Check if the file is the one
			// that was registered during the uninstall hook.
			if ( __FILE__ == WP_UNINSTALL_PLUGIN ) {
				static::uninstall_plugin();
			}
		}
	}

}

?>