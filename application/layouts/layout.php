<?php 
	$content = $layoutVars[ 'content' ];
	$title = $layoutVars[ 'title' ];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title> <?= $title ?> </title>
		
		<link href="/assets/css/bootstrap-responsive.css" rel="stylesheet" type="text/css"/>
		<link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
		
		<script type='text/javascript' src='/assets/js/bootstrap.js'></script>
	</head>
	<body>	    
		<div class = "container">
			<?= $content ?>
		</div>
	</body>
</html>
