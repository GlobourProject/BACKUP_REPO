<?php

require 'database.php';

$message = '';

if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])):
	// Enter the new user in the database
	$sql = "INSERT INTO users.login (email, password, first_name, last_name) VALUES (:email, :password, :first_name, :last_name)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':first_name', $_POST['first_name']);
	$stmt->bindParam(':last_name', $_POST['last_name']);

	$hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password', $hashedPassword);

	if( $stmt->execute()):
		$message = 'Successfully created new user';
	else:
		$message = 'Sorry an error occured during the creating of your account.';
	endif;

endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
	<div class = "goHome_Login">
		<a href="index.php">Learn More</a>
	</div>
	<?php if(!empty($message)):	?>
		<p><?= $message ?></p>
	<?php endif;?>
	<h1>Become A Globour</h1>
	<span>or <a href = "login.php" class = "loginAndRegister_Link">login here</a></span>
	<form action = "register.php" method = "POST">
		<input type = "text" placeholder="Please enter your email" name = "email">
		<input type = "text" placeholder="Please enter your fist name" name = "first_name">
		<input type = "text" placeholder="Please enter your last name" name = "last_name">
		<input type = "password" placeholder = "Please enter a password" name = "password">
		<input type = "password" placeholder = "Please confirm your password" name = "confirm_password">
		<input type = "submit">
	</form>
</body>
</html>