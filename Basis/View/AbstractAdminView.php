<?php

/**
 * Base class for Admin views.
 */

namespace Basis\View;

/**
 * Base class for Admin views.
 * 
 * @package Basis
 * @subpackage View
 */
abstract class AbstractAdminView extends AbstractView implements AdminViewInterface {

	/**
	 * Display a notice near the top of admin page.
	 *
	 * @see AdminViewInterface
	 *
	 */
	public static function admin_notice( $message, $message_type ) {

		if ( empty( self::$admin_notices ) ) {
			add_action( 'admin_notices', array( get_class(), 'display_admin_notices' ) );
		}
		
		$class = self::get_notice_class( $message_type );
		
		self::$admin_notices [] = array( 'message' => $message, 'class' => $class );
	}

	/**
	 * Display admin notices.
	 */
	public static function display_admin_notices() {

		foreach ( self::$admin_notices as $notice ) {
			printf( '<div class="%1$s"><p>%2$s</p></div>', $notice->class, $notice->message );
		}
	}

	/**
	 * Specify HTML class to be applied to messages of the specified message type
	 * 
	 * @param string $message_type
	 */
	private static function get_notice_class( $message_type ) {

		$notice_class = 'notice';
		
		if ( self::is_valid_message_type( $message_type ) ) {
			$notice_class .= " notice-$message_type";
		} else {
			self::log_message( __METHOD__, "Ignoring unrecognized message type $message_type" );
		}
		
		return $notice_class;
	}

	/**
	 * Determine whether specified message type is valid.
	 * 
	 * @param string $message_type
	 * 
	 * @return bool true if valid, false if not
	 */
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

	/**
	 * List of admin notices to display.
	 */
	private static $admin_notices = array();

}

?>