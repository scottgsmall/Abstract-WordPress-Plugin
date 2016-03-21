<?php

/**
 * Interface for activatable component, i.e. a component that needs
 * to do something when the plugin of which it is a part gets activated
 * or deactivated.
 */

namespace Basis\Control\Activation;

use Basis\ComponentInterface;

/**
 * Interface for activatable component, i.e. a component that needs 
 * to do something when the plugin of which it is a part gets activated 
 * or deactivated.
 * 
 * @package Basis
 * @subpackage Control\Activation
 */
interface ActivatableInterface extends ComponentInterface {

	/**
	 * Prepare to use the plugin during single or network-wide activation.
	 *
	 * @param bool $network_wide        	
	 */
	public function activate( $network_wide );

	/**
	 * Roll back activation procedures when de-activating the plugin.
	 */
	public function deactivate();

}

?>