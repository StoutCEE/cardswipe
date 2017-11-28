<!DOCTYPE HTML>
<html>
	<?php
		ini_set("display_errors","On");

	?>
	<head>
		<title>Card Swipe</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div id="content">
			<h1>Please Swipe Card</h1>
			<form action="swiped.php" method="post">
				<input type="number" name="id" autofocus></input>
				<input type="submit">Submit</input> 
			</form>
		</div>
	</body>
	
</html>
