<?php

class models_dataGatewayMysql
{
	
	private static $instance;
	public $link;
	
	private function __construct()
	{
		// Conectar al servidor de DB
		$link = mysqli_connect($_SESSION['register']['config']['db.server'],
							   $_SESSION['register']['config']['db.user'],
							   $_SESSION['register']['config']['db.password'],
							   $_SESSION['register']['config']['db.database']
							);
		// Conectar a la BD
		//mysqli_select_db($config['db.database']);
		$this->link = $link;
	}
	
	static public function newInstance()
	{
		if(isset(self::$instance))
			return self::$instance;
		else
		{
			self::$instance = new models_dataGatewayMysql();
			return self::$instance;
		}
			
	}
	
	/**
	 * Connect to Mysql
	 * @param array $config
	 * @return resource $cnx
	 */
	function connectDB($config)
	{
		// Conectar al servidor de DB
		$cnx = mysqli_connect($config['db.server'],$config['db.user'],
							  $config['db.password'],$config['db.database']);
		// Conectar a la BD
		//mysqli_select_db($config['db.database']);
		
		return $cnx;
	}
	
	/**
	 * Disconnect from Mysql 
	 * @param unknown $cnx
	 */
	function disconnectDB($cnx)
	{
		mysqli_close($cnx);
		return;
	}

}

