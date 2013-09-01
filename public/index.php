<?php
/**
 * Entry of entire application ( setted on .htaccess ) .
 * Requires autoload function autoload.php
 * Defines constants APPLICATION_ENV, NO_CONTROLLER and NO_ACTION
 * Sets configuration file path
 * Instances class /application/Application.php
 * 
 * @filesource /public/index.php
 */

require_once ( 'autoload.php' );

define( 'APPLICATION_ENV' , getenv( 'APPLICATION_ENV' ) );

if ( !defined( 'APPLICATION_ENV' ) )
	define( 'APPLICATION_ENV' , 'production' );

define( 'NO_ACTION' , 'no_action' );
define( 'NO_CONTROLLER' , 'no_controller' );

$config = "../application/configs/config.ini";	

$application = new Application( $config , APPLICATION_ENV );

$application->Bootstrap()->frontController();

// Con inyección de dependencias: $application->Bootstrap(new frontController);

// SEQUENCE
// index.php
//  1) requires autoload.php with __autoload() magic method
//  2) defines constants
//  3) instantiates application/Application.php
//  4) calls Application->Bootstrap()
//		a) instantiates application/Bootstrap.php and stores at $this->_bootstrap
//			-> startRegister()	starts session and $_SESSION[ 'register' ] and $_SESSION[ 'app' ]
//			-> readConfig() 	reads config and stores it at $_SESSION[ 'register' ][ 'config' ]
//			-> router()			explodes $_SERVER[ 'REQUEST_URI' ] to find controller, action and possible params and stores at $this->_route array
//			-> acl()			checks if users has permissions to access actual controller and action and stores route at $this->_route array
//		b) returns application instance
//  5) calls Application->frontController( $this->_bootstrap )
//		a) composes controller class name from $bootstrap->getRoute()[ 'controller' ]
//		b) instantiates controller and calls action $bootstrap->getRoute()[ 'action' ] <- returns content
//		c) calls helpers/actionHelpers.php controllers_helpers_actionHelpers::renderLayout( $layout , $vars )
