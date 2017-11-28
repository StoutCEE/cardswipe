<html>

	<?php
		$username = "root";
		$password = "4455667788";
		$dbname = "signin";
		
		// Create connection
		$conn = mysqli_connect($SERVER_NAME, $username, $password, $dbname);
		
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		
		$id = $_POST["id"];
		
		$sql = "INSERT INTO `signin`.`allswipes` (`ts`, `personnelId`) VALUES (NOW(), $id)";
		
		if (mysqli_query($conn, $sql)) {
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		mysqli_close($conn);
	?>

	<head>
		<title>Thank You!</title>
		<link rel="stylesheet" href="resources/general.css">
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
	
	<?php
		echo '<script type="text/javascript">
				setTimeout(window.location.assign("cardswipe.php"), 3);
			</script>';
	?>
</html>