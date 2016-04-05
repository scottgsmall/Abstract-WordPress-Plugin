<?php

/**
 * Main plugin file for Basis plugin.
 */

/**
 Plugin Name: Basis
 Plugin URI:  https://github.com/scottgsmall/Abstract-WordPress-Plugin.git
 Description: Collection of abstract base classes and libraries upon which to build actual
 WordPress plugins using OO design and MVC pattern.
 Version:     0.1
 Author:      Scott Small
 Author URI:  http://rhythmalitic.com
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once __DIR__ . '/vendor/autoload.php';

