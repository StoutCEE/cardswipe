<?php

/* This script WILL NOT WORK unless generate.php is also required */

// Set MySQL username and password
$username = "";
$password = "";

// Set database names and default database
$db_inventory = "cee_inventory";    //So we can reuse code for inventory system
$db_cardswipe = "cee_cardswipe";
$currentDB = $db_cardswipe;         //Default to cardswipe database

// Cardswipe table defaults
$dbt_timestamp = ["timestamps","time","id"];
$dbt_students = ["students","id","username","name","surname","major","graduation"];

// URLS for registering new user and checking in
$url_swipeCard = $global_hURL[1];
$url_addStudent = $global_hURL[2];

// Simple functions to connect and disconnect to databases
function connectDB(){
	$s = $_SERVER['SERVER_NAME'];
	$u = $GLOBALS['username'];
	$p = $GLOBALS['password'];
	$d = $GLOBALS['currentDB'];
	
	$connection = mysqli_connect($s, $u, $p, $d) or die("Connection failed: " . mysqli_connect_error());
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	return $connection;
} function disconnectDB($connection) {
	mysqli_close($connection);
}

// Log student id and time into database
function cardswipe($id, $connection){

	$msg  = "";
	$id = $_POST["id"];
	$db = $GLOBALS['db_cardswipe'];
	$t  = $GLOBALS['dbt_timestamp'];
	$sql = "INSERT INTO $db.$t[0] ($t[1], $t[2]) VALUES (NOW(), $id);";
	
	if (!mysqli_query($connection, $sql)) {
		$msg = "ERROR: " . mysqli_error($connection);
		header("refresh:10; url=" . $GLOBALS['url_swipeCard']);
	} else {
		// Get student's name
		$msg = findStudent($id, $connection);
	}
	
	return $msg;
}

// Get student name if it is in the database
function findStudent($id, $connection){
	
	$msg  = "";
	$id = $_POST["id"];
	$db = $GLOBALS['db_cardswipe'];
	$t  = $GLOBALS['dbt_students'];
	
	// Looking for name of student with the given ID
	$sql = "SELECT $t[3] FROM $t[0] WHERE  $t[1] = $id";
	$find = mysqli_query($connection, $sql);
	
	if (!$find) {
		$msg = "ERROR" . mysqli_error($connection);
	} else if (mysqli_num_rows($find) == 1) {        //Student found
		header("refresh:2; url=" . $GLOBALS['url_swipeCard']);
		$msg = msg_addimg('Welcome, ' . mysqli_fetch_assoc($find)[$t[3]] . '!');
	} else {                                         //Student not in database
		header("refresh:10; url=" . $GLOBALS['url_swipeCard']);
		$msg = '<form action="' . $GLOBALS['url_addStudent'] . '" method="post">
				<p>You aren\'t registered with the CEE Lab</p>
				<input type="number" name="id" style="display: none" value='. $id .'></input>
				<input type="submit" value="Register" class="btn" autofocus /> 
			</form>';
	}
	
	return $msg;
}

// Add student to database
function addStudent($connection){

	$msg = "";
	$t  = $GLOBALS['dbt_students'];
	
	// Take posted information (from form) and insert
	$i = $_POST[$t[1]];
	$u = $_POST[$t[2]];
	$f = $_POST[$t[3]];
	$l = $_POST[$t[4]];
	$m = $_POST[$t[5]];
	$g = $_POST[$t[6]];
	$db = $GLOBALS['db_cardswipe'];
	$sql = "INSERT INTO $db.$t[0] ($t[1],$t[2],$t[3],$t[4],$t[5],$t[6]) VALUES ($i,'$u','$f','$l','$m',$g);";
	
	if (!mysqli_query($connection, $sql)) {
		header("refresh:10; url=" . $GLOBALS['url_swipeCard']);
		$msg = "ERROR: " . $sql;
	} else {
		header("refresh:1; url=" . $GLOBALS['url_swipeCard']);
		$msg = msg_addimg('Thanks, ' . $f . '!');
	}
	
	return $msg;
}

// Generate form for adding a student. Don't ask for student ID if they've already swiped their card
function addStudentForm(){
	
	$t  = $GLOBALS['dbt_students'];
	
	if (isset($_POST[$t[1]])) {    //We have an id, so we can focus on the username
		$conf_id = 'value=' . $_POST["id"];
		$conf_un = 'autofocus';
	} else {                       //We know nothing about the user, so we need to ask the id first
		$conf_id = 'autofocus';
		$conf_un = '';
	}
	
	// Return HTML
	return '<form action="' . $GLOBALS['url_addStudent'] . '" method="post">
			<table>
				<tr><td>Student ID:</td><td><input type="number" name="'.$t[1].'" ' . $conf_id . '></input></td></tr>
				<tr><td>Stout Username:</td><td><input type="text" name="'.$t[2].'" ' . $conf_un . '></input></td></tr>
				<tr><td>First (Given) Name:</td><td><input type="text" name="'.$t[3].'" ></input></td></tr>
				<tr><td>Last (Family) Name:</td><td><input type="text" name="'.$t[4].'" ></input></td></tr>
				<tr><td>Major:</td><td><input type="text" name="'.$t[5].'" value="CEE" ></input></td></tr>
				<tr><td>Graduation Year:</td><td><input type="number" name="'.$t[6].'"  value="2017"></input></td></tr>
			</table>
			<input type="submit" class="btn" /> 
		</form>';
}
?>
