<?php //echo html header ?>
<?php
	// do the session stuff?
	include_once('session.php');
	
	$username = "username";
	$password = "password";
	$dbname = "database";
	//$server = $_SERVER['SERVER_NAME];

	//create connection
	//$conn = mysqli_connect($SERVER_NAME, $username, $password, $dbname);
	$conn = mysqli_connect($username, $password, $dbname);


	//check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());	
	}
	echo "Connected successfully";
?>
<form autocomplete="on">
	<input type="text" name="username" placeholder="username" required />
	<input type="password" name="password" placeholder="password" required />
	<input type="submit" value="Login" />
</form>
<?php //echo html footer ?>
