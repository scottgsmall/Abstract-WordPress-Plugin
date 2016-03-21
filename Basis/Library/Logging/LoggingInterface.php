<?php

/**
 * Interface for classes with logging support.
 */

namespace Basis\Library\Logging;

/**
 * Interface for classes with logging support.        
 */
interface LoggingInterface {
	
	/**
	 * Write a message to the WordPress error log.
	 * 
	 * @param string $method name of class method that produced the message
	 * @param string $message message text
	 */
	public static function log_message( $method, $msg );

}

?>