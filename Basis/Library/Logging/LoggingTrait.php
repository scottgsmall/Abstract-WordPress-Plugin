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

		if ( WP_DEBUG ) {
			$class = get_called_class();
			error_log( "$class::$method:$message" );
		}
	}

}

?>