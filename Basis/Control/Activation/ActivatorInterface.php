<?php

namespace Basis\Control\Activation;

/**
 * Interface for master activator class that activates all the other
 * activatable classes in the plugin.
 */
interface ActivatorInterface extends ActivatableInterface {
	
	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @param int $blog_id
	 */
	public function activate_new_site( $blog_id );

}

?>