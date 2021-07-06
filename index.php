<?php
session_start();
require_once 'php/dbConnect.php';

$userSub = $_SESSION['user']['login'];

if ($_SESSION['mainContent'] == 'subs') {
	if ($_SESSION['user']) {
		$subs = [];
		$sql = "SELECT * FROM subs WHERE `user` = '$userSub'";
		$subsCheck = mysqli_query($connect, $sql) or die(mysqli_error($connect));
		$subsCount = mysqli_num_rows($subsCheck);
		for ($i = $subsCount; $i > 0; $i--) { 
			$row = mysqli_fetch_assoc($subsCheck);
			$subs[$i] = $row['sub'];
		}

		$imgNames = [];
		$subsCount = count($subs); 

		$sql = "SELECT * FROM usersimg";
		$result = mysqli_query($connect, $sql)
			or die("Ошибка: " . mysqli_error($link));

		$rows = mysqli_num_rows($result);

		$index = 0;
		for ($i = 0; $i < $rows; $i++) {
			$row = mysqli_fetch_assoc($result);
			for ($j = 1; $j <= $subsCount; $j++) {
				if ($row['userName'] == $subs[$j]) {
					$imgNames[$index] = $row['fileName'];
					$index = $index + 1;
				}
			}
		}
		$rows = count($imgNames);
		// echo "Rows = " . $rows . '<br>';
		// print_r($imgNames);
	} else {
		$notReg = true;
	}
} elseif ($_SESSION['mainContent'] == 'all') {
	$imgNames = [];
	$sql = "SELECT * FROM usersimg";
	$result = mysqli_query($connect, $sql)
		or die("Ошибка: " . mysqli_error($link));
	$rows = mysqli_num_rows($result);
	for ($i = 1; $i <= $rows; $i++) {
		$row = mysqli_fetch_assoc($result);
		$imgNames[$i - 1] = $row['fileName'];
	}
	$rows = count($imgNames);
}

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
	<link rel="stylesheet" type="text/css" href="css/forms.css">

	<title>Main - NewGallery</title>
</head>

<body>
	<?php
		require_once 'php/header.php';

		if ($_SESSION['uploadMessage']) {
			echo "<div class='container'> \n";
			echo '<p class="formMessage">' . $_SESSION['uploadMessage'] . '</p>';
			echo "</div>";
		unset($_SESSION['uploadMessage']);
		}
	?>

	<!-- <div class="container_banner">
		<img src="img/camera_banner.jpg">
		<div class="textBlock">
			<h1>NewGallery</h1>
			<h2>Your new gallery every day</h2>
		</div>
	</div> -->

	<div class="container">
		<nav>
			<a href="php/showSubs.php">
				<h2 class="navButton <?php if ($_SESSION['mainContent'] == 'subs') {echo "black";} ?>">Show subscriptions</h2>
			</a>
			<a href="php/showAll.php">
				<h2 class="navButton <?php if ($_SESSION['mainContent'] == 'all') {echo "black";} ?>">Show all posts</h2>
			</a>
		</nav>
	</div>


	<div class="container gallery">
	<?php
		if ($notReg === true) {
			echo "<h2><a href='register.php'>You need an account to subscribe to any users! Register now.</a></h2>";
		}
		for ($i = $rows - 1; $i >= 0; $i--) { 
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