<?php

namespace Basis\Library\Singleton;

trait SingletonTrait {

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