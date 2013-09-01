<?php
/**
 * Bootstrap
 * Starts session, reads and parses config, routes and checks acl.
 * 
 * @filesource application/Bootstrap.php
 * 
 * @property private array $_config
 * @property private string $_env
 * @property private string $_route
 *
 */
class Bootstrap
{	
	private $_config;
	private $_env;
	private $_route;
	
	/**
	 * Initializes properties of Bootstrap.
	 * Calls startRegister(), readConfig(), router() and acl()
	 * 
	 * @param array $config
	 * @param string $env
	 * 
	 * @return void
	 */
	public function __construct( $config , $env )
	{
		$this->_config = $config;
		$this->_env = $env;		
		
		$this->startRegister();
		$this->readConfig();		
		$this->router();
// 		$this->acl();

		$_SESSION[ 'register' ][ 'route' ] = $this->_route;
	}
	
	/**
	 * Starts session and starts $_SESSION['register'] and $_SESSION['app']
	 * 
	 *  @return void
	 */
	protected function startRegister()
	{
		session_start();
		
		$_SESSION[ 'register' ] = array();
		$_SESSION[ 'app' ] = array();		
	}
	
	/**
	 * Reads configuration file $this->config for $this->env section and
	 * saves values in $_SESSION['register']['config']
	 * 
	 * @return void
	 */
	protected function readConfig()
	{
		$config = parse_ini_file( $this->_config , true );
		$config = $config[ $this->_env ];

		$_SESSION[ 'register' ][ 'config' ] = $config;	
	}	
	
	/**
	 * Explodes $_SERVER['REQUEST_URI'] in controller, action and vars pairs.
	 * Checks if controller exists and if it has indicated action.
	 * Saves values on $this->route['controller'] and $this->route['action'].
	 * 
	 * @return void
	 */
	protected function router()								// TODO:	Revisar condiciones de router
	{
		$config = $_SESSION[ 'register' ][ 'config' ];
			
		$controllerActions = array(	'index'	=>	array( 'index' ),
									'users'	=>	array( 'login' , 'logout' )
		);

		$parse = explode( '/' , $_SERVER[ 'REQUEST_URI' ] );

		$route[ 'controller' ] = $parse[ 1 ];
		@$route[ 'action' ] = $parse[ 2 ];					// FIXME:	13-03-2013	(Bootstrap::router)	Silent warning with @
		
		if ( file_exists( $config[ 'path.controllers' ] . "/" . $route[ 'controller' ] . "Controller.php" ) )
		{
			if ( in_array( $route[ 'action' ] , $controllerActions[ $route[ 'controller' ] ] ) )
			{
				for ( $i = 3 ; $i < sizeof( $parse ) ; $i += 2 )
				{
					$_REQUEST[ $parse[ $i ] ] = $parse[ $i + 1 ];
				}
			}
			else
			{
				$route[ 'controller' ] = 'error';
				$route[ 'action' ] = 'index';
			}
		}
		else
		{
			if ( empty( $parse[ 1 ] ) )
			{
				$route[ 'controller' ] = 'index';
				$route[ 'action' ] = 'index';
			}
			else
			{
				$route[ 'controller' ] = 'error';
				$route[ 'action' ] = 'index';
			}
		}
		
		$this->_route = $route;
	}
	
	/**
	 * Checks if $_SESSION['idrol'] exists and compares with its permissions for controllers and actions.
	 * Default values:
	 * $this->route['controller'] = 'index';
	 * $this->route['action'] = 'index';
	 * 
	 * @return void
	 */
	protected function acl()
	{
		$route = $this->_route;
		
		if ( !isset( $_SESSION[ 'idrol' ] ) )
		{
			$_SESSION[ 'idrol' ] = 0;				// FIXME: HARDCODE DEFAULT ROL
		}
		
		$permissions = array( '0'	=>	array( 'users' . '.' . 'login' ),
							  '1'	=>	array( 'index' . '.' . 'index',
												'error' . '.' . 'index' ),
		);
		
		if ( isset( $_SESSION[ 'iduser' ] ) )
		{
			if ( in_array( $route[ 'controller' ] . '.' . $route[ 'action' ] , $permissions[ $_SESSION[ 'idrol' ] ] ) )
			{
				$this->_route = $route;
			}
		}
		elseif ( $_SESSION[ 'idrol' ] === 4 )
		{
			if ( in_array( $route[ 'controller' ] . '.' . $route[ 'action' ] , $permissions[ $_SESSION[ 'idrol' ] ] ) )
			{
				$this->_route = $route;
			}
		}
		else
		{ 
			if ( $this->_route[ 'controller' ] !== 'error' )
			{
				$route[ 'controller' ] = 'users';
				$route[ 'action' ] = 'login';
			}
		}
		
		$this->_route = $route;
	}		

	/**
	 * Gets array $this->route with $this->route['controller'] and $this->route['action']
	 * 
	 * @return the $route
	 */
	public function getRoute()
	{
		return $this->_route;
	}
	
		
}