<?php
/**
 * Application's front controller.
 * Receives Bootstrap instance $route and instances indicated controller and runs indicated action by $route.
 * Shows indicated layout on __destruct().
 * 
 * @filesource /application/controllers/frontController.php
 *
 * @property private array $_config
 * @property private output buffer $_layout
 */
class controllers_frontController
{	
	protected $_config;
	private $_content;
	private $_layout;
	
	public function __construct( Bootstrap $bootstrap )
	{	
		$this->_config = $_SESSION[ 'register' ][ 'config' ];
		
		$route = $bootstrap->getRoute();
		
		if ( isset( $_SESSION[ 'iduser' ] ) )
			unset ( $_SESSION[ 'iduser' ] );
		else
			$_SESSION[ 'iduser' ] = 0;
		
		if ( isset( $_SESSION[ 'iduser' ] ) )
		{
			$controller = "controllers_" . $route[ 'controller' ] . "Controller";
			$action = $route[ 'action' ] . "Action";
		}
		else
		{
			$_SESSION[ 'register' ][ 'route' ][ 'controller' ] = 'users';
			$_SESSION[ 'register' ][ 'route' ][ 'action' ] = 'login';
			$controller = "controllers_usersController";
			$action = "loginAction";
		}
		
		$instance = new $controller;
		$this->_content = $instance->$action(); 
		
		$layoutVars = array( 'content'	=>	$this->_content,
							 'title'	=>	'MVC-BASE'
		);

		$this->_layout = controllers_helpers_actionHelpers::renderLayout( $this->_config[ 'default.layout' ] , $layoutVars );
	}

	public function __destruct()
	{
		echo $this->_layout;
	} 
}