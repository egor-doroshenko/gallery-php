<?php
session_start();
if ($_SESSION['user']) {
	header("Location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/container.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/imgBlock.css">
	<link rel="stylesheet" type="text/css" href="css/fullImg.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<title>Sign in/Join - Newgallery</title>
</head>
<body>
	<?= require_once 'php/header.php' ?>

	<div class="fullScreen">
		<form action="php/log.php" method="post">
			<label class="topLabel">Sign in with your account</label>
			<label>Login:</label>
			<input type="text" name="login" placeholder="Your login here...">
			<label>Password:</label>
			<input type="password" name="password" placeholder="Your password here...">
			<button type="submit">Sign in!</button>
			<h2>
				<a class="bottom20px" href="register.php">Need account?</a>
			</h2>
			<?php
				if ($_SESSION['formMessage']) {
					echo '<p class="formMessage">' . $_SESSION['formMessage'] . '</p>';
				}
				unset($_SESSION['formMessage']);
			?>
		</form>
	</div>
</body>
</html>