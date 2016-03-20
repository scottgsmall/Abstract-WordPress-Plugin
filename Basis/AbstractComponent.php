<?php

namespace Basis;

use Basis\Library\Singleton\SingletonInterface;
use Basis\Library\Singleton\SingletonTrait;
use Basis\Library\Logging\LoggingTrait;

/**
 * Base class for components of this plugin.
 */
abstract class AbstractComponent implements ComponentInterface, SingletonInterface {
	
	use LoggingTrait;
	use SingletonTrait;
	
	/**
	 * Does nothing by default. Override as appropriate.
	 * 
	 * @see \Basis\ComponentInterface::register_callbacks()
	 */
	public function register_callbacks() {

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