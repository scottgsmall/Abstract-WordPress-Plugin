<?php

namespace Basis\Control;

use Basis\Library\Logging\LoggingTrait;
use Basis\Library\Singleton\SingletonTrait;
use Basis\Library\Singleton\SingletonInterface;

abstract class AbstractController implements ControllerInterface, SingletonInterface {
	
	use LoggingTrait;
	use SingletonTrait;

	/**
	 * Register callbacks for actions and filters associated with this controller.
	 */
	abstract protected function register_hook_callbacks();
	
	/**
	 * Enqueue CSS, JavaScript, etc. associated with this controller.
	 */
	abstract protected function load_resources();

	protected function __construct() {

		$this->register_hook_callbacks();
		$this->load_resources();
	}

}

?>