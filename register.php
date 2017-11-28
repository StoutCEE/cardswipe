<?php 
require "res/generate.php";
require "res/dbaccess.php";

$title = "Register";
$output = "";

if (isset($_POST[$dbt_students[2]])) {
	$c = connectDB();
	$output = addStudent($c);
	disconnectDB($c);
} else {
	$output = addStudentForm();
}

echoLayout($output,$title);
?>