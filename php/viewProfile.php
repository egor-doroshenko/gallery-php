<?php
session_start();
require_once 'dbConnect.php';

if ($_SESSION['user']['login'] === $login) {
	header('Location: ../../profile.php');
}

$user = $_SESSION['user']['login'];
$sql = "SELECT * FROM subs WHERE `user` = '$user' && `sub` = '$login' ";
$subCheck = mysqli_query($connect, $sql) or die(mysqli_error($connect));
$isSub = mysqli_fetch_assoc($subCheck);

if ($_SESSION['goBack']) {
	$login = $_SESSION['goBack'];
	unset($_SESSION['goBack']);
}



$imgNames = [];
$sql = "SELECT * FROM usersimg WHERE `userName` = '$login'";
$result = mysqli_query($connect, $sql)
	or die("Ошибка: " . mysqli_error($link));

$rows = mysqli_num_rows($result);
for ($i = 0; $i < $rows; $i++) {
	$row = mysqli_fetch_row($result);
	$imgNames[$i] = $row[1];
}

$sql = "SELECT * FROM subs WHERE `sub` = '$login'";
$subsCheck = mysqli_query($connect, $sql);
$subsCount = mysqli_num_rows($subsCheck);
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
	<link rel="stylesheet" type="text/css" href="../../css/imgDescription.css">
	<link rel="stylesheet" type="text/css" href="../../css/comments.css">
	<link rel="stylesheet" type="text/css" href="../../css/forms.css">
	<link rel="stylesheet" type="text/css" href="../../css/links.css">

	<title><?php echo $login; ?> (profile) - NewGallery</title>
</head>
<body>
	<?php require_once 'headerForPHP.php' ?>

	<div class="container">
		<div class="imgBlock">
			<img class="profileAvatar" src="<?php echo "../../usersImg/" . $avatarPath; ?>">
		</div>
		
		<div class="contentBlock">
			<h2><?php echo $login; ?> profile</h2>
			<?php
				echo "<p>Subscribers: " . $subsCount . "</p>\n";
			?>
			<form method="post" action="../subscribe.php" class="bgNone">
				<input type="hidden" name="subName" value="<?php echo $login; ?>">

				<?php 
					if ($isSub) {
						echo '<input type="hidden" name="subAction" value="unsubscribe">';
						echo '<button>Unubscribe</button>';
					} else {
						echo '<input type="hidden" name="subAction" value="subscribe">';
						echo '<button>Subscribe</button>';
					}
				?>
			</form>
		</div>
	</div>

	<div class="container gallery">
		<?php	
			for ($i=$rows - 1; $i >= 0; $i--) { 
				echo "<div class='imgBlock'>";
				echo "<a href='../usersImg/" . $imgNames[$i] . ".php'>";
				echo "<img src='../../usersImg/" . $imgNames[$i] . "'>";
				echo "</a>";
				echo "</div>";
			}
		?>
	</div>
</body>
</html>