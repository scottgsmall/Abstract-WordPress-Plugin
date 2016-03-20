<?php

namespace Basis\View;

use Basis\Library\Logging\LoggingTrait;

/**
 * Base class for Admin views.
 */
abstract class AbstractAdminView extends AbstractView implements AdminViewInterface {
	
	use LoggingTrait;

	public static function admin_notice( $message, $message_type ) {

		if ( empty( self::$admin_notices ) ) {
			add_action( 'admin_notices', array( get_class(), 'display_admin_notices' ) );
		}
		
		$class = self::get_notice_class( $message_type );
		
		self::$admin_notices [] = array( 'message' => $message, 'class' => $class );
	}

	public static function display_admin_notices() {

		foreach ( self::$admin_notices as $notice ) {
			printf( '<div class="%1$s"><p>%2$s</p></div>', $notice->class, $notice->message );
		}
	}

	private static function get_notice_class( $message_type ) {

		$notice_class = 'notice';
		
		if ( self::is_valid_message_type( $message_type ) ) {
			$notice_class .= " notice-$message_type";
		} else {
			self::log_message( __METHOD__, "Ignoring unrecognized message type $message_type" );
		}
		
		return $notice_class;
	}

	private static function is_valid_message_type( $message_type ) {

		switch ( $message_type ) {
			case self::MESSAGE_TYPE_SUCCESS :
			case self::MESSAGE_TYPE_INFO :
			case self::MESSAGE_TYPE_WARNING :
			case self::MESSAGE_TYPE_ERROR :
				return true;
		}
		
		return false;
	}

	private static $admin_notices = array();

}

?>