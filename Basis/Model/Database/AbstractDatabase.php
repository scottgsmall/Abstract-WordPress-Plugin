<?php

/**
 * Base class for database model components.
 */

namespace Basis\Model\Database;

use Basis\Model\AbstractModel;

/**
 * Base class for database model components.
 * 
 * @package Basis
 * @subpackage Model\Database
 */
abstract class AbstractDatabase extends AbstractModel {
	
	public static function table_exists( $table_name ) {
		
		global $wpdb;
		
		return ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name );
	}

}

?>