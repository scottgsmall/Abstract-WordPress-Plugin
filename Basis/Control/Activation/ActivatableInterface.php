<?php

namespace Basis\Control\Activation;

/**
 * Interface for class that needs to do something when the plugin of
 * which it is a part gets activated or deactivated.
 */
interface ActivatableInterface {

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