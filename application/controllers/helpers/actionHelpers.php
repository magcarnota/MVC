<?php
/**
 * Helper class for controllers
 * 
 * @author spirit
 *
 */
class controllers_helpers_actionHelpers
{
	/**
	 * Render view with viewVars
	 * 
	 * @param string $config
	 * @param string $view
	 * @param array $viewVars
	 * @return string $content
	 */
	static function renderView( $view , array $viewVars = NULL )
	{
		ob_start();
		
		include_once ( $_SESSION[ 'register' ][ 'config' ][ 'path.views' ] . "/" . $view );
		
		$content = ob_get_clean();
		ob_end_clean();
		
		return $content;
	}
	
	/**
	 * Render layouts with layoutsVars
	 * @param array $config
	 * @param string $layout
	 * @param array $layoutVars
	 * @return string $layoutOut
	 */
	static function renderLayout( $layout = NULL , array $layoutVars = NULL )
	{
		if( $layout === NULL )
			$layout = $_SESSION[ 'register' ][ 'config' ][ 'default.layout' ];
		
		ob_start();
		
		include_once ( $_SESSION[ 'register' ][ 'config' ][ 'path.layouts' ] . "/" . $layout );
		
		$layoutOut = ob_get_contents();
		ob_end_clean();
		
		return $layoutOut;	
	}
	
	static function debug( $data , $label = '' )
	{
		echo "<pre>" . $label . ": ";
		print_r( $data );
		echo "</pre>";
	}

}


