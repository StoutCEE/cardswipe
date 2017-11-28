<?php 
require "res/generate.php";
require "res/dbaccess.php";

$title = "Check In";
$output = "";

if (isset($_POST['id'])) {
	$id = $_POST["id"];
	$c = connectDB();
	$output = cardswipe($id, $c);
	disconnectDB($c);
} else {
	$output = '
		<form action="' . $GLOBALS['url_swipeCard'] . '" method="post">
			<p>Please swipe card:</p>
			<input type="number" name="id" autofocus></input>
			<input type="submit" style="display: none" /> 
		</form>';
}

echoLayout($output,$title);
?>
