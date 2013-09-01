<?php
/**
 * Loads dinamically classes.
 * All classes are named as controllers_className, models_className, etc ...
 * Explodes by underscore and includes folder controllers, models, etc... and className.php file
 * 
 * @param string $var class
 * @throws Exception File not found
 * 
 * @return void
 */
function __autoload( $var )
{	
	try
	{
		$path = str_replace( '_' , '/' , $var ) . ".php";
		if ( file_exists( '../application/' . $path ) )
			include_once( '../application/' . $path );
		else
			throw new Exception( "File not found!" );
	}
	catch ( Exception $e )
	{
		echo '--- Exception: ' . $e->getMessage() . "\n";
	}
}