<?php

namespace Basis\Control\Activation;

/**
 * Interface for master activator class that activates all the other
 * activatable classes in the plugin.
 */
interface ActivatorInterface extends ActivatableInterface {
	
	/**
	 * Perform all actions necessary during the plugin's activation.
	 *
	 * @param bool $network_wide
	 */
	public function activate( $network_wide );
	
	/**
	 * Perform all actions necessary during the plugin's deactivation.
	 */
	public function deactivate();
	
	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @param int $blog_id
	 */
	public function activate_new_site( $blog_id );

}

?>