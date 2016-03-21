<?php

/**
 * Interface for Admin views.
 */

namespace Basis\View;

/**
 * Interface for Admin views.   
 * 
 * @package Basis
 * @subpackage View
 */
interface AdminViewInterface extends ViewInterface {
	
	const MESSAGE_TYPE_SUCCESS = 'success';
	const MESSAGE_TYPE_INFO = 'info';
	const MESSAGE_TYPE_WARNING = 'warning';
	const MESSAGE_TYPE_ERROR = 'error';

	/**
	 * Display a notice near the top of admin page.
	 * 
	 * @param string $message
	 * @param string $message_type one of the MESSAGE_TYPE_* values above.
	 * 
	 * @note We assume $message has already been translated by the caller.
	 * 
	 */
	public static function admin_notice( $message, $message_type ); 
}

?>