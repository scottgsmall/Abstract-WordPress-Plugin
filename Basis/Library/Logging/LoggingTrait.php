<?php

namespace Basis\Library\Logging;

trait LoggingTrait {

	protected static function log_message( $method, $msg ) {

		if ( WP_DEBUG ) {
			error_log( __CLASS__ . "::$method:$msg" );
		}
	}

}

?>