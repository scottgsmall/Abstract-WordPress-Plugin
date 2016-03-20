<?php

namespace Control\Installation;

interface InstallerInterface {

	// Note: there is no WordPress install hook, so this class has no 
	// install() method
	
	public static function uninstall();
	
	public static function uninstall_plugin();
}

?>