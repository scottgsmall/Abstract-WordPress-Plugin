<?php

namespace Basis\Control\Exceptions;

use Basis\Library\Logging\LoggingTrait;

abstract class AbstractException extends \Exception {
	
	use LoggingTrait;

	/**
	 *
	 * @param
	 *        	message[optional]
	 *        	
	 * @param
	 *        	code[optional]
	 *        	
	 * @param
	 *        	previous[optional]
	 *        	
	 */
	public function __construct( $message = null, $code = null, $previous = null ) {
		
		// TODO - log message
		
		parent::__construct( $message = null, $code = null, $previous = null );
	}

}

?>