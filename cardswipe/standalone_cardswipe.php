<html>

	<head>
		<title>Card Swipe</title>
	</head>
	
	<body>
		<?php
			if (isset($_POST['id'])) {
				$username = "username";
				$password = "database";
				$dbname = "database";
				$server = $_SERVER['SERVER_NAME'];
				
				// Create connection
				$conn = mysqli_connect($server, $username, $password, $dbname);
				
				// Check connection
				if (!$conn) {
				    die("Connection failed: " . mysqli_connect_error());
				}
				
				$id = $_POST["id"];
				
				$sql = "INSERT INTO $dbname.`timestamps` (`time`, `id`) VALUES (NOW(), $id);";
				
				if (mysqli_query($conn, $sql)) {
					header("refresh:1; url=standalone_cardswipe.php");
					echo '<div id="content">
							<h1>Thanks!</h1>
						</div>';
				} else {
					header("refresh:3; url=standalone_cardswipe.php");
					echo "An error has occurred";
				}
				
				mysqli_close($conn);
			} else {
				echo '<div id="content">
						<h1>Please Swipe Card</h1>
						<form action="standalone_cardswipe.php" method="post">
							<input type="text" name="id" autofocus></input>
							<input type="submit" style="display: none" /> 
						</form>
					</div>';
			}
		?>
	</body>
</html>
