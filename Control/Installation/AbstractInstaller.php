<?php

namespace Control\Installation;

abstract class AbstractInstaller implements InstallerInterface {

	abstract protected function install_plugin();

	abstract protected function uninstall_plugin();

	public static function uninstall() {

		if ( current_user_can( 'activate_plugins' ) ) {
			check_admin_referer( 'bulk-plugins' );
			
			// Important: Check if the file is the one
			// that was registered during the uninstall hook.
			if ( __FILE__ == WP_UNINSTALL_PLUGIN ) {
				self::uninstall_plugin();
			}
		}
	}

}

?>