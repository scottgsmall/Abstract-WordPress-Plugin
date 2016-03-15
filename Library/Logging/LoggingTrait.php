<?php

namespace Library\Logging;

trait LoggingTrait {

	protected static function log_message( $method, $msg ) {

		if ( WP_DEBUG && self::DO_LOG_MESSAGES ) {
			error_log( __CLASS__ . "::$method:$msg" );
		}
	}

}

?>