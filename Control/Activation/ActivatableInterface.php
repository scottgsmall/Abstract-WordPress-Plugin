<?php

namespace Control\Activation;

use Library\Singleton\SingletonInterface;

interface ActivatableInterface extends SingletonInterface {

	/**
	 * Prepares sites to use the plugin during single or network-wide activation.
	 *
	 * @param bool $network_wide        	
	 */
	public function activate( $network_wide );

	/**
	 * Rolls back activation procedures when de-activating the plugin.
	 */
	public function deactivate();

}

?>