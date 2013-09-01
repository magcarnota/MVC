<div class="alert alert-warning">
	Versión beta de acceso reservado.
</div>
<div class="panel panel-primary">
<div class="panel-heading">
	<h3 class="panel-title">Acceso</h3>
</div>
<form class="form-horizontal" method="POST" action="http://mvc-base.local/users/login" enctype="application/x-www-form-urlencoded">
  <div class="form-group">
    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" id="inputEmail" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
    <div class="col-lg-4">
      <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>
    <div class="col-lg-2">
      <button type="submit" class="btn btn-primary">Acceder</button>
    </div>
  </div>
</form>
</div>
<?php 
	if ( $_SESSION[ 'register' ][ 'config' ][ 'show.route' ] ):
		views_helpers_viewHelpers::showDebug( debug_backtrace() , __FILE__ , true );
	endif;
?>