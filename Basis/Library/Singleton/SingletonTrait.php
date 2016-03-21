<?php

/**
 * Trait providing singleton support for using class.
 */

namespace Basis\Library\Singleton;

/**
 * Trait providing singleton support for using class.
 * 
 * @package Basis
 * @subpackage Library\Singleton
 */
trait SingletonTrait {

	/**
	 * Get singleton instance of this class.
	 * 
	 * @see SingletonInterface::get_instance()
	 */
	final public static function get_instance() {

		static $instance = null;
		
		if ( null === $instance ) {
			$instance = new static();
		}
		
		return $instance;
	}

	/**
	 * Private clone method to prevent cloning of the instance of the
	 * *Singleton* instance.
	 *
	 * @return void
	 */
	private function __clone() {

	}

	/**
	 * Private unserialize method to prevent unserializing of the *Singleton*
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup() {

	}

}

?>