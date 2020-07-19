<?php 

	session_start();

 ?>





<!DOCTYPE html>

<html>



<head>

	<meta charset="utf-8">

	<title>Reglog Test</title>

</head>



<body>



 	<main>

 		<h1>Signup</h1>

 		<?php 

 			if ( isset($_GET['error']) ) {

 				if ($_GET['error'] == "emptyfields") {

 					echo '<h3>Fill in all fields!</h3>';

 				}

 				else if ($_GET['error'] == "invalidmailuid") {

 					echo '<h3>Enter correct e-mail!</h3>';

 				}

 			}

 			if ( isset($_GET['signup']) ) {
				if ($_GET['signup'] == "success") {

					echo '<h3>You\'re successfully signed up!</h3>';

				}
			}

 			

 		 ?>

 		<form action="includes/signup.inc.php" method="post">

 			<input type="text" name="uid" placeholder="Username">

 			<input type="text" name="mail" placeholder="E-mail">

 			<input type="password" name="pwd" placeholder="Password">

 			<input type="password" name="pwd-repeat" placeholder="Repeat password">

 			<button type="submit" name="signup-submit">Signup</button>

 		</form>

 		<br>

 		<?php

 		if (isset($_SESSION['userId'])) {

 			echo '

 			<form action="includes/logout.inc.php" method="post">

	 			<button type="submit" name="logout-submit">Logout</button>

	 		</form>

	 		<br>';

	 		

 		}

 		else {

 			echo '

 			<h1>Login</h1>

	 		<form action="./includes/login.inc.php" method="post">

	 			<input type="text" name="mailuid" placeholder="E-mail/Username">

	 			<input type="password" name="pwd" placeholder="Password"><br>

	 			<button type="submit" name="login-submit">Login</button>

	 		</form>

	 		<a href="reset-password.php">Forgor your password?</a>';



	 		if ( isset($_GET['newpwd']) ) {

	 			if ($_GET['newpwd'] == 'passwordupdated') {

	 				echo '<p>Your password has been reset!</p>';

	 			}

	 		}



 		}



 		 ?>





 		



 	</main>



</body>

</html>