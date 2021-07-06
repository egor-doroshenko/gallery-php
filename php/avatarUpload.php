<?php
session_start();
require_once 'dbConnect.php';

$login = $_SESSION['user']['login'];
$avatarPath = 'avatars/' . time() . $_FILES['avatar']['name'];
if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../usersImg/' . $avatarPath)) {
	$_SESSION['formMessage'] = "Avatar uploading error! Please, try again or use different image.";
	header('Location: ../profile.php');
}

$sql = "UPDATE `users` SET `avatar` = '$avatarPath' WHERE `login` = '$login'";
mysqli_query($connect, $sql);
$_SESSION['user']['avatar'] = $avatarPath;

$_SESSION['uploadMessage'] = "Avatar changed.";
header('Location: ../profile.php');
?>