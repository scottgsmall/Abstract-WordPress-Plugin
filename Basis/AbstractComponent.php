<?php

/**
 * Base class for components of this plugin.
 */
namespace Basis;

use Basis\Library\Singleton\SingletonInterface;
use Basis\Library\Singleton\SingletonTrait;
use Basis\Library\Logging\LoggingTrait;
use Basis\Library\Logging\LoggingInterface;
use Basis\Control\Exceptions\BasisException;

/**
 * Base class for components of this plugin.
 *
 * Provides trivial default implementations of the generic component
 * methods; derived classes must override these as appropriate.
 *
 * Also provides logging and singleton support.
 *
 * @see ComponentInterface
 *
 * @package Basis
 */
abstract class AbstractComponent implements ComponentInterface, SingletonInterface, LoggingInterface {
	
	use LoggingTrait;
	use SingletonTrait;

	/**
	 * Does nothing by default.
	 * Override as appropriate.
	 *
	 * @see \Basis\ComponentInterface::register_callbacks()
	 */
	public function register_callbacks() {

		return $this;
	}

	/**
	 * Does nothing by default.
	 * Override as appropriate.
	 *
	 * @see \Basis\ComponentInterface::load_resources()
	 */
	public function load_resources() {

		return $this;
	}

	/**
	 * Does nothing by default.
	 * Override as appropriate.
	 *
	 * @see \Basis\ComponentInterface::run()
	 */
	public function run() {

		return $this;
	}

	/**
	 * Tell this component what plugin it is a part of.
	 *
	 * @see \Basis\ComponentInterface::set_plugin_file()
	 */
	public function set_plugin_file( $plugin_file ) {

		if ( ! file_exists( $plugin_file ) ) {
			throw new BasisException( "Plugin file $plugin_file does not exist" );
		} else {
			$this->plugin_file = $plugin_file;
		}
		
		return $this;
	}

	/**
	 * Get fully qualified name of main plugin file for plugin of which this class is a component.
	 *
	 * @see \Basis\ComponentInterface::get_plugin_file()
	 */
	public function get_plugin_file() {

		if ( ! isset( $this->plugin_file ) ) {
			throw new BasisException( 'Plugin file is not defined' );
		}
		
		return $this->plugin_file;
	}

	/**
	 * Main plugin file for plugin of which this class is a component.
	 *
	 * @var string
	 */
	private $plugin_file;

}

?>