<?php
/**
 * Index Controller
 * 
 * @version 1.0 
 * 
 */
class controllers_indexController
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
		$this->_content = controllers_helpers_actionHelpers::renderView( 'index/index.php' , $this->_viewVars );
		return $this->_content;
	}
	
	public function errorAction()
	{
		$this->_content = controllers_helpers_actionHelpers::renderView( 'error/error.php' , $this->_viewVars );
		return $this->_content;
	}	

}



