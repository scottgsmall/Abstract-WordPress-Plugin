<?php

namespace Basis\Model\Plugin;

use Basis\Model\ModelInterface;
/**
 * Interface for main plugin class.
 */
interface PluginInterface extends ModelInterface {

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name();

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return string The version number of the plugin.
	 */
	public function get_version();

}

?>