<?php
class controllers_usersController
{
	private $_content;
	private $_viewVars;

	public function __construct()
	{
		$this->_content = "";
		$this->_viewVars = null;
	}

	public function indexAction()
	{
		$this->_content = controllers_helpers_actionHelpers::renderView( 'users/index.php' , $this->_viewVars );
		return $this->_content;
	}
	
	public function loginAction()
	{
		if ( $_POST )
		{
			$_SESSION[ 'idrol' ] = 1;
			$_SESSION[ 'iduser' ] = 0;
			
			$this->_content = var_dump( $_POST );
			
// 			header("Location: http://mvc-base.local");	
		}
		else
		{
// 			$this->_content = var_dump( $_POST );
			$this->_content = controllers_helpers_actionHelpers::renderView( 'users/login.php' , $this->_viewVars );
		}
		
// 		$this->_content = controllers_helpers_actionHelpers::renderView( 'users/login.php' , $this->_viewVars );
		return $this->_content;
	}
	
	public function logoutAction()
	{
// 		session_destroy();
		if ( isset( $_SESSION[ 'iduser'] ) )
			unset( $_SESSION[ 'iduser'] );
		else
			$_SESSION[ 'iduser' ] = 0;
		
		header("Location: /");
	}
	
}