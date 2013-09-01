<?php
class views_helpers_viewHelpers
{
	public static function showDebug( $debugArray , $fileView , $showSessionArray = FALSE )
	{
		echo '
			<div class="panel panel-primary" style="margin-top: 20px;">
			<div class="panel-heading">
			<h3 class="panel-title">
			INFO
			<span class="label label-success pull-right">' . $_SESSION[ 'register' ][ 'route' ][ 'action' ] . "Action" . '</span>
						<span class="label label-danger pull-right" style="margin-right: 5px;">' . $_SESSION[ 'register' ][ 'route' ][ 'controller' ] . "Controller" . '</span>
					</h3>
				</div>
			  	<p>';
					$counter = 0;
					foreach ( array_reverse( $debugArray ) as $file ):
							echo "<span class=\"badge\">" . $counter++ . "</span> " . trim( $file[ "file" ] ) . "<br>";
					endforeach;

		echo '</p>
				<p>
					<a class="btn btn-default" href="/users/logout">SALIR</a>
				</p>
			  		<div class="accordion-group">
			    		<div class="accordion-heading">
			      			<a class="accordion-toggle" data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">
			        			Mostrar debug
			      			</a>
			    		</div>
			    		<div id="collapseOne" class="accordion-body collapse in">
			      			<div class="accordion-inner">
			      				<pre>';
// 			        				echo var_dump( $debugArray );
			        				if ( $showSessionArray )
			        					echo var_dump( $_SESSION );
			        				if ( isset( $_POST ) )
			        					echo var_dump( $_REQUEST );
		echo '
			      				</pre>
			      			</div>
			    		</div>
			  		</div>
			
			  	<div class="panel-footer text-right"><em>' . $fileView . '</em></div>
			</div>
		';
	}
}