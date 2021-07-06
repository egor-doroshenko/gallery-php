<?php
session_start();
require_once 'php/dbConnect.php';
if (!$_SESSION['user']) {
	header("Location: login.php");
}

$userName = $_SESSION['user']['login'];

$imgNames = [];
$sql = "SELECT * FROM usersimg WHERE `userName` = '$userName'";
$result = mysqli_query($connect, $sql)
	or die("Ошибка: " . mysqli_error($connect));

$rows = mysqli_num_rows($result);
for ($i = 0; $i < $rows; $i++) {
	$row = mysqli_fetch_row($result);
	$imgNames[$i] = $row[1];
}

$sql = "SELECT * FROM subs WHERE `sub` = '$userName'";
$subsCheck = mysqli_query($connect, $sql);
$subsCount = mysqli_num_rows($subsCheck);
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
	<link rel="stylesheet" type="text/css" href="css/fullImg.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/avatar.css">
	<link rel="stylesheet" type="text/css" href="css/links.css">
	<link rel="stylesheet" type="text/css" href="css/forms.css">

	<title>Profile - NewGallery</title>
</head>

<body>
	<?php require_once 'php/header.php' ?>

	<div class="container borderSolid buttonContainer">
		<a href="php/logout.php"> <h1>Log out</h1> </a>
	</div>

	<?php
		if ($_SESSION['uploadMessage']) {
			echo '<div class="container">';
			echo '<p class="formMessage">' . $_SESSION['uploadMessage'] . '</p>';
			echo '</div>';
		}
		unset($_SESSION['uploadMessage']);	
	?>

	<div class="container">
		<div class="imgBlock">
			<img class="profileAvatar" src="<?= "usersImg/" . $_SESSION['user']['avatar'] ?>">
		</div>
		
		<div class="contentBlock">
			<h2>Welcome to your profile, <?= $_SESSION['user']['login'] ?>!</h2>
			<p> <strong>Nice to meet you.</strong> </p>
			<?php
				echo "<p>Subscribers: " . $subsCount . "</p>\n";
			?>
			<div>
				<a class="button bottom5px" href="avatarChange.php">Change avatar</a>
				<a class="button bottom5px" href="profileEdit.php">Edit your profile data</a>
			</div>
		</div>
	</div>

	<div class="container gallery">
	<?php	
		for ($i=$rows - 1; $i >= 0; $i--) { 
			echo "<div class='imgBlock'>";
			echo "<a href='php/usersImg/" . $imgNames[$i] . ".php'>";
			echo "<img src='usersImg/" . $imgNames[$i] . "'>";
			echo "</a>";
			echo "</div>";
		}
	?>
	</div>

	<div class="container">
		<h1>NewGallery</h1>
	</div>

	<div class="container">
		<a href="#">
			<h2 class="navButton">GitHub</h2>
		</a>
		<a href="#">
			<h2 class="navButton">Instagram</h2>
		</a>
		<a href="#">
			<h2 class="navButton">Facebook</h2>
		</a>
		<a href="#">
			<h2 class="navButton">TikTok</h2>
		</a>
		<a href="#">
			<h2 class="navButton">YouTube</h2>
		</a>
	</div>
</body>
</html>