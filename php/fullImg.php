<?php
	session_start();
	require_once 'dbConnect.php';

	$sql = "SELECT * FROM `usersimg` WHERE `fileName` = '$imgName'";
	$imgDataQuery = mysqli_query($connect, $sql);
	$imgData = mysqli_fetch_assoc($imgDataQuery);
	$imgAuthor = $imgData['userName'];
	$imgAbout = $imgData['imgAbout'];

	$sql = "SELECT * FROM comments WHERE `imgName` = '$imgName'";
	$commentsCheck = mysqli_query($connect, $sql)
		or die(mysqli_error($connect));
	$rows = mysqli_num_rows($commentsCheck);
	for ($i = 0; $i < $rows; $i++) { 
		$row = mysqli_fetch_assoc($commentsCheck);
		$comments[$i] = $row;
	}
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

	<title>Full image - NewGallery</title>
</head>

<body>
	<?php require_once 'headerForPHP.php' ?>

	<div class="container buttonContainer">
		<a class="bigButton" href="../../index.php">
			<h1>Go back</h1>
		</a>
	</div>

	<div class="container">
		<p>Author: <?php echo '<a href="../profiles/' . $imgAuthor . '.php">@' . $imgAuthor . "</a>\n"; ?></p>
	</div>

	<div class="container">
		<img class="fullImg" src="../../usersImg/<?php echo $imgName; ?>">
	</div>

	<div class="container">
		<div class="imgDescription">
			<h3>Photo description by <?php echo $imgAuthor; ?>: </h3>
			<p><?php echo $imgAbout; ?></p>
		</div>
	</div>

	<div class="container">
		<form class="commentForm" action="../uploadComment.php" method="post">
			<input type="hidden" name="imgNameDB" value="<?php echo $imgNameDB; ?>">
			<input type="hidden" name="imgName" value="<?php echo $imgName; ?>">
			<input type="hidden" name="user" value="<?php echo $_SESSION['user']['login']; ?>">
			<?php
				if ($_SESSION['user']) {
					echo '<label class="topLabel">Write your comment</label>';
					echo '<textarea class="imgAbout" name="comment"></textarea>' . "\n";
					echo '<button>Send</button>';
				} else {
					echo '<label class="topLabel">Only registered users can write comments. <a href="../../register.php">Join us</a></label>' . "\n";
				}
			?>
		</form>
	</div>

	<div class="container">
		<?php
			$commentsCount = count($comments);
			if ($commentsCount > 0) {
				for ($i = $commentsCount; $i > 0; $i--) { 
					echo "<div class='comment'> \n";
					echo '	<a href="../profiles/' . $comments[$i - 1]['user'] . '.php"> <h2 class="commentAuthor">@' . $comments[$i - 1]['user'] . "</h2> </a>\n";
					echo '	<p>' . $comments[$i - 1]['comment'] . "</p> \n";
					echo "</div>";
				}
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