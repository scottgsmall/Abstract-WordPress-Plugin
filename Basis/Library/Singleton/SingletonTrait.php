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
	public static function get_instance() {

		static $instance;
		
		if ( ! isset( $instance ) ) {
			$instance = new static();
		}
		
		return $instance;
	}
	
	/**
	 * Protected constructor for singleton class.
	 */
	protected function __construct() {
		
	}

	/**
	 * Private clone method to prevent cloning of the singleton instance.
	 *
	 * @return void
	 */
	private function __clone() {

	}

	/**
	 * Private unserialize method to prevent unserializing of the singleton
	 * instance.
	 *
	 * @return void
	 */
	private function __wakeup() {

	}

}

?>