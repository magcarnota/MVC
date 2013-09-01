<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title" >Error</h3>
	</div>
	<p class="alert alert-info" >Page not found!</p>
	<p>
		<?php
			$counter = 0;
			foreach ( array_reverse( debug_backtrace() ) as $file ):
 				echo "<span class=\"badge\">" . $counter++ . "</span> " . trim( $file[ "file" ] ) . "<br>";
			endforeach;
		?>
	</p>
	<p>
		<a class="btn btn-default btn-medium" href="\">Return to index</a>
	</p>
</div>