<?php

/**
 * Interface for class providing various static utility methods.
 */
namespace Basis\Library\Utility;

/**
 * Interface for class providing various static utility methods.
 *
 * @package Basis
 * @subpackage Library\Utility
 */
interface UtilityInterface {

	/**
	 * Get URL of current page.
	 *
	 * @return string
	 */
	public static final function current_page_url();

	/**
	 * Determine whether the specified class implements the specified interface.
	 *
	 * @param string $class        	
	 * @param string $interface        	
	 * @throws LibraryException if specified class or interface does not exist
	 * 
	 * @return bool 
	 */
	public static final function class_implements_interface( $class, $interface );
	
	/**
	 * Determine whether the specified value is an alphanumeric string.
	 * 
	 * @param unknown $value
	 */
	public static final function is_alphanumeric_string( $value );

}

?>