<?php

/**
 * Trait for classes with logging support.
 */
 
namespace Basis\Library\Logging;

/**
 * Trait for classes with logging support.
 * 
 * @package Basis
 * @subpackage Library\Logging
 */
trait LoggingTrait {

	/**
	 * Write a message to the WordPress error log.
	 * 
	 * @see LoggingInterface::log_message
	 */
	public static function log_message( $method, $message ) {

		if ( WP_DEBUG_LOG ) {
			$class = addslashes( get_called_class() );
			$method = addslashes( $method );
			error_log( sprintf( '%s::%s:%s', $class, $method, $message ) );
		}
	}

}

?>