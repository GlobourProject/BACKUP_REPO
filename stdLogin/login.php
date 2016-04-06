<?php
session_start();
require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	$records=$conn->prepare('SELECT id, email, password, first_name, last_name FROM users.login WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$message = '';
	if(count($results) > 0 && password_verify($_POST['password'], $results['password']))
	{
		$_SESSION['user_id'] = $results['id'];
		header("Location: index.php");
	}
	else
	{
		$message = 'Sorry those credentials do not match.';
	}
session_write_close();
endif;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
	<div class = "goHome_Login">
		<a href="index.php">Learn More</a>
	</div>
	<?php if(!empty($message)):	?>
		<p><?= $message ?></p>
	<?php endif;?>
	
	<form action = "login.php" method = "POST">
		<input type = "text" placeholder="Enter your email" name = "email">
		<input type = "password" placeholder = "*******" name = "password">
		<input type = "submit">
	</form>
</body>
</html>