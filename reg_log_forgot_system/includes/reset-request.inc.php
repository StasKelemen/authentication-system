<?php 

	if ( isset($_POST['reset-request-submit']) ) {

		$selector = bin2hex(random_bytes(8));

		$token = random_bytes(32);



		$url = "liassic-worries.000webhostapp.com/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);



		$expires = date("U") + 1800;


		require 'dbh.inc.php';

		$userEmail = $_POST['email'];


		$sql = 'DELETE FROM pwdReset WHERE pwdResetEmail=?';

		$stmt = mysqli_stmt_init($conn);

		if ( !mysqli_stmt_prepare($stmt, $sql) ) {

			echo 'There was an error of delete the previous token!';

			exit();

		} else {

			mysqli_stmt_bind_param($stmt, 's', $userEmail);

			mysqli_stmt_execute($stmt);

		}



		$sql = 'INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)';

		$stmt = mysqli_stmt_init($conn);

		if ( !mysqli_stmt_prepare($stmt, $sql) ) {

			echo 'There was an error of inserting new token!';

			exit();

		} else {

			$hashed_token = password_hash($token, PASSWORD_DEFAULT);

			mysqli_stmt_bind_param($stmt, 'ssss', $userEmail, $selector, $hashed_token, $expires);

			mysqli_stmt_execute($stmt);

		}



		mysqli_stmt_close($stmt);

		mysqli_close($conn);



		$to = $userEmail;

		$subject = 'Reset your password';

		$message = '<p>We recieved a password reset request. The link to reset your password make this request is below. If you did note make this request, you can ignore this email</p>';

		$message .= '<p>Here is your password reset link: <br>';

		$message .= '<a href="' . $url . '">' . $url . '</a></p>';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From: KLMN <liassic-worries@liassic-worries.000webhostapp.com>\r\n";
		$headers .= "Reply-To: liassic-worries@liassic-worries.000webhostapp.com\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

		$mail = mail($to, $subject, $message, $headers);

		if ($mail) {
			header('Location: ../reset-password.php?reset=success');
		} else {
			header('Location: ../reset-password.php?reset=error');
		}

	}

	else {

		header('Location: ../index.php');

	}