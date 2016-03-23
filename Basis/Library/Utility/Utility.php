<?php

/**
 * Class providing various static utility methods.
 */

namespace Basis\Library\Utility;

use Basis\Library\LibraryException;

/**
 * Class providing various static utility methods.
 * 
 * @package Basis
 * @subpackage Library\Utility
 */
abstract class Utility {

	/**
	 * Get URL of current page.
	 * 
	 * @see UtilityInterface::current_page_url()
	 */
	public static final function current_page_url() {

		$pageURL = 'http';
		if ( isset( $_SERVER ["HTTPS"] ) ) {
			if ( $_SERVER ["HTTPS"] == "on" ) {
				$pageURL .= "s";
			}
		}
		
		$pageURL .= "://";
		
		if ( $_SERVER ["SERVER_PORT"] != "80" ) {
			$pageURL .= $_SERVER ["SERVER_NAME"] . ":" . $_SERVER ["SERVER_PORT"] . $_SERVER ["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER ["SERVER_NAME"] . $_SERVER ["REQUEST_URI"];
		}
		
		return $pageURL;
	}

	/**
	 * Determine whether the specified class implements the specified interface.
	 * 
	 * @see UtilityInterface::class_implements_interface()
	 */
	public static final function class_implements_interface( $class, $interface ) {

		$result = false;
		
		if ( ! class_exists( $class ) ) {
			throw new LibraryException( "Class $class does not exist" );
		} elseif ( ! interface_exists( $interface ) ) {
			throw new LibraryException( "Interface $interface does not exist" );
		} else {
			$reflection_class = new \ReflectionClass( $class );
			$result = $reflection_class->implementsInterface( $interface );
		}
		
		return $result;
	}
	
	public static final function is_alphanumeric_string( $value ) {
		
		return is_string( $value ) && preg_match( '/^[A-Z0-9]{4,64}$/i', $value );
	}

}

?>