<?php

session_start();
require_once 'dbConnect.php';

$imgName = $_FILES['image']['name'];
$imgTmp = $_FILES['image']['tmp_name'];
$imgAbout = $_POST['imgAbout'];
$userName = $_SESSION['user']['login'];

if (!move_uploaded_file($imgTmp, '../usersImg/' . time() . $imgName)) {
	$_SESSION['uploadMessage'] = "Upload error. Please, try again!";
	header('Location: ../upload.php');
} else {
	$imgName = time() . $imgName;
	$imgNameDB = str_replace('.', '', $imgName);
	$sql = "INSERT INTO usersimg (fileName, userName, imgAbout)
	VALUES ('$imgName', '$userName', '$imgAbout')";
	mysqli_query($connect, $sql);

	$imgFilePhp = fopen("usersImg/" . $imgName . ".php", w);
	fwrite($imgFilePhp, "<?php \n");
	fwrite($imgFilePhp, '$imgName = "' . $imgName . '";' . "\n");
	fwrite($imgFilePhp, '$imgNameDB = "' . $imgNameDB . '";' . "\n");
	fwrite($imgFilePhp, "include ('../fullImg.php');\n");
	fwrite($imgFilePhp, '$str = htmlentities(file_get_contents("../fullImg.php"));' . "\n");
	fwrite($imgFilePhp, '?>');
	fclose($imgFilePhp);

	// $sql = "CREATE TABLE `$imgNameDB` (
 //  		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
 //  		user VARCHAR(50) NOT NULL,
 //  		comment VARCHAR(255) NOT NULL
	// )";
	// mysqli_query($connect, $sql)
	// 	or die("Не прошёл запрос в БД" . mysqli_error($connect));

	$_SESSION['uploadMessage'] = "Your photo has been uploaded, " . $userName . '!';
	header('Location: ../upload.php');
}



?>