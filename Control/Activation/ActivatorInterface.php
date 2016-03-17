<?php

namespace Control\Activation;

interface ActivatorInterface extends ActivatableInterface {
	
	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @param int $blog_id
	 */
	public function activate_new_site( $blog_id );

}

?>