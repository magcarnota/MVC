<?php 
	if ( $_SESSION[ 'register' ][ 'config' ][ 'show.route' ] ):
			views_helpers_viewHelpers::showDebug( debug_backtrace() , __FILE__ , true );
	endif;
?>
