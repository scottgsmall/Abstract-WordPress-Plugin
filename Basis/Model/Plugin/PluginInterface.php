<?php

/**
 * Interface for main plugin component.
 */
 
namespace Basis\Model\Plugin;

use Basis\Model\ModelInterface;

/**
 * Interface for main plugin component.
 * 
 * @package Basis
 * @subpackage Model\Plugin
 */
interface PluginInterface extends ModelInterface {
	
	/**
	 * Get plugin file name.
	 * 
	 * @return string
	 */
	public function get_plugin_file();
}

?>