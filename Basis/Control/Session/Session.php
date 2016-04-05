<?php

namespace Basis\Control\Session;

use Basis\Library\Singleton\SingletonInterface;
use Basis\Library\Singleton\SingletonTrait;
use Basis\Library\Logging\LoggingTrait;

/**
 * Class encapsulating the PHP Session
 */
class Session implements SingletonInterface {
	
	use LoggingTrait;
	use SingletonTrait;
	
	public function __get( $name ) {

		return isset( $_SESSION[$name] ) ? $_SESSION[$name]  : null;
	}

	public function __isset( $name ) {

		return isset( $_SESSION[$name] );
	}

	public function __unset( $name ) {

		unset( $_SESSION[$name] );
	}
	
	/**
	 * Destroy all of the data associated with the current session.
	 * 
	 * Returns true if session was destroyed, false if not.
	 */
	public function destroy()
	{
		$session_destroyed = false;
		
		if ( $this->$session_started )
		{
			$session_destroyed = session_destroy();
			if ( ! $session_destroyed ) {
				self::log_message( __METHOD__, 'Failed to destroy session' );
			}
			
			unset( $_SESSION );
			$this->session_started = false;
		}
	
		return $session_destroyed;
	}

	/**
	 * Protected constructor for singleton class.
	 */
	protected function __construct() {
		
		parent::__construct();

		$this->session_started = session_start();
		
		if ( ! $this->session_started ) {
			self::log_message( __METHOD__, 'Failed to start session' );
		}
	}

	private $session_started = false;

}

?>