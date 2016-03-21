<?php

/**
 * Base class for components of this plugin.
 */

namespace Basis;

use Basis\Library\Singleton\SingletonInterface;
use Basis\Library\Singleton\SingletonTrait;
use Basis\Library\Logging\LoggingTrait;
use Basis\Library\Logging\LoggingInterface;

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
	 * Does nothing by default. Override as appropriate.
	 * 
	 * @see \Basis\ComponentInterface::register_callbacks()
	 */
	public function register_callbacks( $plugin_file ) {

		return $this;
	}
	
	/**
	 * Does nothing by default. Override as appropriate.
	 * 
	 * @see \Basis\ComponentInterface::load_resources()
	 */
	public function load_resources() {
	
		return $this;
	}
	
	/**
	 * Does nothing by default. Override as appropriate.
	 * 
	 * @see \Basis\ComponentInterface::run()
	 */
	public function run() {
	
		return $this;
	}

}

?>