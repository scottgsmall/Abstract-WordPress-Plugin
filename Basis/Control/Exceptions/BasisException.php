<?php

/**
 * Base class for exceptions thrown in this plugin.
 */
 
namespace Basis\Control\Exceptions;

use Basis\Library\Logging\LoggingTrait;

/**
 * Base class for exceptions thrown in this plugin.
 * 
 * Logs each exception to WordPress error log.
 * 
 * @package Basis
 * @subpackage Control\Exceptions
 */
class BasisException extends \Exception {
	
	use LoggingTrait;

	/**
	 * Constructor.
	 * 
	 * @see \Exception   	
	 */
	public function __construct( $message = null, $code = null, $previous = null ) {

		parent::__construct( $message = null, $code = null, $previous = null );
		
		self::log_message( __METHOD__, $message );
	}

}

?>