<?php

namespace Basis\Control\Installation;

/**
 * Interface for class that needs to do clean-up when the plugin
 * of which it is a part is uninstalled.
 * 
 * @ note 
 */
interface InstallableInterface {

	public static function uninstall();
}

?>