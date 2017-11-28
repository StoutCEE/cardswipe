<html>

	<head>
		<title>Card Swipe</title>
		<link rel="stylesheet" href="resources/general.css">
	</head>
	
	<body>
		<div id="content">
			<h1>Please Swipe Card</h1>
			<form action="swiped.php" method="post">
				<input id="idInputField" type="text" name="id"></input>
				<input type="submit" style="display: none" /> 
			</form>
		</div>
		<script>
			var idInputField = document.getElementById("idInputField");
			idInputField.focus();
		</script>
	</body>
	
</html>