<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot password</title>
</head>
<body>
	<h1>Reset your password</h1>
	<p>An e-mail will be send to you with instructions on how to reset your password</p>
	<form action="includes/reset-request.inc.php" method="post">
		<input type="text" name="email" placeholder="Enter your e-mail address...">
		<button type='submit' name='reset-request-submit'>Receive new password by email</button>
	</form>
	<?php 
		if (isset($_GET['reset'])) {
			if ($_GET['reset'] == 'success') {
				echo '<h3>Check your e-mail!</h3>';
			} elseif ($_GET['reset'] == 'error') {
				echo "<h3>Error! Message haven't been sent!</h3>";
			}
		} 
	?>
</body>
</html>