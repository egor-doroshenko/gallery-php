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
	<?php require_once 'php/header.php' ?>

	<div class="fullScreen">
		<form action="php/reg.php" method="post" enctype="multipart/form-data">
			<label class="topLabel">Registration form</label>
			<label>Login:</label>
			<input type="text" name="login" placeholder="Your login here...">
			<label>E-mail:</label>
			<input type="email" name="email" placeholder="Your email here...">
			<label>Password:</label>
			<input type="password" name="password" placeholder="Your password here...">
			<label>Confirm your password:</label>
			<input type="password" name="passwordConfirm" placeholder="Confirm your here...">
			<label>Profile image:</label>
			<input class="button" type="file" name="avatar">
			<button type="submit">Register</button>
			<?php
				if ($_SESSION['formMessage']) {
					echo '<p class="formMessage">' . $_SESSION['formMessage'] . '</p>';
				}
				unset($_SESSION['formMessage']);
				
			?>
			<h2>
				<a class="bottom20px" href="login.php">Already have an account?</a>
			</h2>
		</form>
	</div>
</body>
</html>