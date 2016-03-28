<?php

/**
 * Interface for activatable component, i.e. a component that needs
 * to do something when the plugin of which it is a part gets activated
 * or deactivated.
 */

namespace Basis\Control\Activation;


/**
 * Interface for activatable component, i.e. a component that needs 
 * to do something when the plugin of which it is a part gets activated 
 * or deactivated.
 * 
 * @package Basis
 * @subpackage Control\Activation
 */
interface ActivatableInterface  {

	/**
	 * Prepare to use the plugin during single or network-wide activation.
	 *
	 * @param bool $network_wide        	
	 */
	public static function activate( $network_wide );

	/**
	 * Roll back activation procedures when de-activating the plugin.
	 */
	public static function deactivate();

}

?>