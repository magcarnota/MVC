<?php
// TODO:	Patrón singleton para Application
/**
 * Application's main class
 * Stores path $this->config with path of ini file.
 * 
 * @filesource /application/Application.php
 * 
 * @property private string $_config
 * @property private string $_env
 * @property private Bootstrap $_bootstrap
 * 
 * @method Bootstrap()
 * @method frontController()
 */
class Application{
	
	private $_config;
	private $_env;
	private $_bootstrap;
	
	/**
	 * Receives $config string configuration file's path and string $env with environment
	 * 
	 * @param string $config
	 * @param string $env
	 * 
	 * @return void
	 */
	public function __construct( $config , $env )
	{
		$this->_config = $config;
		$this->_env = $env;
	}
	
	/**
	 * Instances Bootstrap and stores in $this->route.
	 * 
	 * @return Application
	 */
	public function Bootstrap()
	{
		$this->_bootstrap = new Bootstrap( $this->_config , $this->_env );
		
		return $this;
	}
	
	/**
	 * Instances controllers_frontController.
	 * 
	 * @return void
	 */
	public function frontController()
	{
		new controllers_frontController( $this->_bootstrap );
	}
}
