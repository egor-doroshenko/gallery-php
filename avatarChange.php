<?php
session_start();
require_once 'php/dbConnect.php';


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
	<title>Change avatar - Newgallery</title>
</head>
<body>
	<?php require_once 'php/header.php'; ?>

	<div class="fullScreen">
		<form action="php/avatarUpload.php" method="post" enctype="multipart/form-data">
			<label class="topLabel">Change your avatar</label>
			<label>Choose image:</label>
			<input class="button" type="file" name="avatar">
			<button type="submit">Change</button>
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