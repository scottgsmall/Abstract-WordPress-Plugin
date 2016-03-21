<?php

/**
 * Interface for activator component responsible for managing activation
 * and deactivation of the other activatable components in this plugin.
 */

namespace Basis\Control\Activation;

/**
 * Interface for activator component responsible for managing activation
 * and deactivation of the other activatable components in this plugin.
 * 
 * @package Basis
 * @subpackage Control\Activation
 */
interface ActivatorInterface extends ActivatableInterface {
	
	/**
	 * Runs activation code on a new WPMS site when it's created
	 *
	 * @param int $blog_id
	 */
	public static function activate_new_site( $blog_id );

}

?>