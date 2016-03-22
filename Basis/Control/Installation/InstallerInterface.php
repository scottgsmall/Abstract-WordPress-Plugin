<?php

/**
 * Interface for installer component responsible for installation and deinstallation
 * of this plugin.
 */

namespace Basis\Control\Installation;

use Basis\ComponentInterface;

/**
 * Interface for installer component responsible for installation and deinstallation
 * of this plugin.
 * 
 * @package Basis
 * @subpackage Control\Installation
 */
interface InstallerInterface extends ComponentInterface {
	
	// Note: there is no WordPress install hook, so this class has no
	// install() method
	
	/**
	 * Clear out any rewrite rules added by the plugin, options and/or
	 * settings specific to to the plugin, other database values that
	 * need to be removed, etc.
	 */
	public static function uninstall();

}

?>