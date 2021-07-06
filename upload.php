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
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/container.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
	<link rel="stylesheet" type="text/css" href="css/imgBlock.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">
	<title>Upload - NewGallery</title>
</head>
<body>
	<?php
		require_once 'php/header.php';
	?>
	<div class="fullScreen">
		<form action="php/uploadPost.php" method="post" enctype="multipart/form-data">
			<label class="topLabel">Choose your photo</label>
			<label>Choose file to upload</label>
			<input type="file" name="image">
			<label>Describe your photo</label>
			<textarea name="imgAbout" maxlength="1000" rows="20"></textarea>
			<button type="submit">Upload</button>
			<?php
				if ($_SESSION['uploadMessage']) {
					echo '<p class="formMessage">' . $_SESSION['uploadMessage'] . '</p>';
					unset($_SESSION['uploadMessage']);
				}
			?>
		</form>
	</div>
</body>
</html>