<!DOCTYPE HTML>
<html>
<head>

	<title>
		CEE Study Lounge Sign-in / Equipment Checkout
	</title>
	<meta charset="utf-8" />
	<meta http-equiv='Pragma' content='no-cache' />
	<?php ini_set("display_errors","1");	?>
	<script src="scripts.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<script>
		console.log("Hello, lab!");
	</script>
	
	<?php 
		// attempt to access  mysql database
		$cardSwipeInput = ""; 
		$displayMode = "";
		if(isset($_REQUEST['cardSwipeInput']) and strlen($_REQUEST['cardSwipeInput']) > 0){
			$cardSwipeInput = $_REQUEST['cardSwipeInput'];
		}
		if(isset($_REQUEST['displayMode']) and strlen($_REQUEST['displayMode']) > 0){
			$displayMode = $_REQUEST['displayMode'];
		}
		
	?>
	<input name="displayMode" type="hidden" value="<?php echo $displayMode;?>" />
	<input name="cardSwipeInput" type="hidden" value="<?php echo $cardSwipeInput;?>" />
</head>
<body>
	<div id="topHeadingDiv" class="floatRight" title="show me the code">
		<h1>CEE Lab sign-in</h1>
	</div>
	
	<!-- this DIV is for debugging output.  the included CSS file should hide this DIV
	by ID and/or class when -->
	<div id="debugOutputDiv" class="debug" title="debugger output should probably be hidden">
		<table>
			<tr>
				<td>displayMode</td><td><?php echo $displayMode;?></td>
			</tr>
			<tr>
				<td>cardSwipeInput</td><td><?php echo $cardSwipeInput;?></td>
			</tr>
		</table>
	</div>
	
	<!-- this php will add the class "hidden" to the following DIV if the displayMode parameter
		has been set to something other than "signin".  If it has not been set, the div will be shown.
		This assumes that the imported CSS sets class div.hidden to be display: none.  
	-->
	<div class="signIn<?php if($displayMode != "signIn" and $displayMode != ""){echo " hidden";}?>" id="signInDiv" title="sign-in here." onclick="clickedOn(this);">

			<div>Fryklund 214 Sign-ins</div>
			<div>
				<form name="signInInputForm" class="signInTable" action="sign-in.php" method="POST">
					
					<input type="text" name="cardSwipeInput" enabled />
					<input type="hidden" name="mode" value="swipe" />
				</form>
			</div>
	</div>
	
	<div class="thankYou<?php if($displayMode != "thankYou"){ echo " hidden";}?>" id="thankYouDiv" title="thanks a hundred.">
		<h2>
			thanks <?php echo $cardSwipeInput;?>
		</h2>
		<!-- TODO put in some sort of javascript code to make a time-limit on this, to re-submit back to 
			reload the page with blank or "signIn" displayMode.  -->
	</div>
	
	<div class="newUser<?php if(displayMode != "newUser"){echo " hidden";}?>" id="newUserDiv" title="new user input">
		<h2>
			New user <?php echo $cardSwipeInput;?>:
		</h2>
		<input type="text" name="newUserNameInput" value="New user" />
	</div>
	
	<div id="dialogDiv" class="hidden dialog" style="display: none; border:2px inset">this div should be hidden</div>
	
	<script>
		signInTable = document.getElementById("signInTable");
		signIn = {
			table : signInTable,
			form : document.forms["signInInputForm"],
			inputRow : document.getElementById("signInInputRow"),
			cardSwipeInput : document.forms["signInInputForm"]["cardSwipeInput"],
			
		};
		signIn.cardSwipeInput.focus(); // when the document is loaded, focus the card-swipe text field.
		signIn.cardSwipeInput.value = "";
		signIn.cardSwipeInput.onkeypress = function (keyEvent){
			console.debug("key press in swiper: ");
			console.info(keyEvent);
			if(keyEvent.charCode >= 48 && keyEvent.charCode <= 57){
				// this code is for numeric inputs, 0-9
				console.debug("it's the number " + keyEvent.key);
				//this.value += keyEvent.key;
				//this.lastValue = this.value;
			}
			else if (keyEvent.key == "Enter" && keyEvent.charCode == 0 && keyEvent.keyCode == 13){
				// this code is for enter pressed, should submit the form if the code is "good".
				console.debug("ENTER pressed, with card ID value == " + this.value);
				signIn.form.submit();
			}
			else {
				//console.debug("bad key: " + keyEvent.key);
				//this.value = this.lastValue;
			}
			// how does this need to be changed to successfully delete bad keys, but keep the numbers?
			
		};
		
		function clickedOn(domElement){
			console.debug("clicked on " + domElement);
			return domElement;
		};
		function keyUp(keyEvent, domElement){
			console.debug("keyUp " +  keyEvent + " in " + domElement.properties['id']);
			return keyEvent;
		};
		function focusTheCardSwipeField(){
			
		};
	</script>
</body>
</html>

