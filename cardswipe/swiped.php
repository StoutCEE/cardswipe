<html>

	<?php
		$logFilename = ".swipes.log.txt";
		$theDate = exec("date +%Y-%m-%d_%H:%M:%S");
		$ekDate = date("Y-m-d H:i:s");
		echo($ekDate);
		function appendToLog ($argument) {
			global $theDate, $logFilename;
			shell_exec("echo " . $theDate . " '" . $argument . "' >> " . $logFilename);
		}
		if(isset($_POST['id']) && strlen($_POST['id']) > 0){
			appendToLog("swiped: " . $_POST['id']);
		} else {
			$badMsg = "bad swipe: " . "\$_POST['id'] not set.";
			appendToLog($badMsg);
			echo $badMsg . '<br />';
		}
		
		$username = "username";
		$password = "password";
		$dbname = "database";
		
		// Create connection
		$conn = mysqli_connect($SERVER_NAME, $username, $password, $dbname);
		
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		
		$id = $_POST["id"];
		
		$sql = "INSERT INTO `database`.`allswipes` (`ts`, `personnelId`) VALUES (NOW(), $id)";
		
		if (mysqli_query($conn, $sql)) {
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		mysqli_close($conn);
		
	?>

	<head>
		<title>Thank You!</title>
		<link rel="stylesheet" href="style.css">
		
		<!-- Time out fuction for the card swipe to go back to   -->
		<script type="text/javascript">
			setTimeout(window.location.assign("cardswipe.php"), 5000);
		</script>
	</head>
	
	<body>
		<div id="content">
			<h1>Thank You!</h1>
			<table>
				<tr>
					<td>User ID:</td>
					<td><?php echo $_POST["id"]; ?></td>
				</tr><tr>
					<td>Current Time:</td>
					<td><?php echo(date("Y-m-d H:i:s")) ?></td>
				</tr>
			</table>
		</div>
	</body>
</html>
