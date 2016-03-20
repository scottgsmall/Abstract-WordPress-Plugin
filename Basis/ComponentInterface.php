<?php

namespace Basis;

/**
 * Interface for components of this plugin.       
 */
interface ComponentInterface {

	public function register_callbacks();
	
	public function load_resources();
	
	public function run();
}

?>