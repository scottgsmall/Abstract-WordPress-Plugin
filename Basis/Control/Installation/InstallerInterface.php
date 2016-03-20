<?php

namespace Basis\Control\Installation;

use Basis\ComponentInterface;
/**
 * Interface for class responsible for installation and deinstallation
 * of this plugin.
 */
interface InstallerInterface extends ComponentInterface {

	// Note: there is no WordPress install hook, so this class has no 
	// install() method
	
	/**
	 * Clear out any rewrite rules added by the plugin, options and/or
	 * settings specific to to the plugin, or other database values that
	 * need to be removed.
	 */
	public function uninstall();
	
}

?>