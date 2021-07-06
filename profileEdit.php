<?php
session_start();
require_once 'php/dbConnect.php';



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../css/main.css">
	<link rel="stylesheet" type="text/css" href="../../css/header.css">
	<link rel="stylesheet" type="text/css" href="../../css/container.css">
	<link rel="stylesheet" type="text/css" href="../../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../../css/imgBlock.css">
	<link rel="stylesheet" type="text/css" href="../../css/fullImg.css">
	<link rel="stylesheet" type="text/css" href="../../css/forms.css">

	<title>Profile edit - NewGallery</title>
</head>

<body>
	<?php require_once 'php/header.php' ?>

	<div class="fullScreen">
		<form action="php/profileDataUpload.php" method="post" enctype="multipart/form-data">
			<label class="topLabel">Edit profile data</label>
			<label>E-mail:</label>
			<input type="email" name="email" placeholder="Your email here...">
			<label>Password:</label>
			<input type="password" name="password" placeholder="New password here...">
			<label>Confirm your password:</label>
			<input type="password" name="passwordConfirm" placeholder="Confirm your new password">
			<button type="submit">Edit</button>
			<?php
				if ($_SESSION['formMessage']) {
					echo '<p class="formMessage">' . $_SESSION['formMessage'] . '</p>';
				}
				unset($_SESSION['formMessage']);
				
			?>
			<h2>
				<a class="bottom20px" href="profile.php">Go back</a>
			</h2>
		</form>
	</div>
</body>