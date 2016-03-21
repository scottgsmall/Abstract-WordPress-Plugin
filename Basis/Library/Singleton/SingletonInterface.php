<?php

/**
 * Interface for singleton classes.
 */

namespace Basis\Library\Singleton;

/**
 * Interface for singleton classes.
 * 
 * @package Basis
 * @subpackage Library\Singleton
 */
interface SingletonInterface {

	/**
	 * Get singleton instance of this class.
	 * 
	 * @return object singleton instance of this class
	 */
	public static function get_instance();

}

?>