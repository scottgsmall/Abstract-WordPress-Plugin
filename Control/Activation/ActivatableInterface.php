<?php

namespace Control\Activation;

interface ActivatableInterface {

	public static function activate();

	public static function deactivate();
	
	public static function check_prerequisite_plugins();

}

?>