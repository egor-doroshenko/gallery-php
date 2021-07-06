<?php
session_start();
require_once 'dbConnect.php';

$comment = $_POST['comment'];
$imgNameDB = $_POST['imgNameDB'];
$imgName = $_POST['imgName'];
$user = $_POST['user'];

$sql = "INSERT INTO comments (user, imgName, comment) VALUES ('$user', '$imgName', '$comment')";
mysqli_query($connect, $sql)
	or die(mysqli_error($connect));
header("Location: usersImg/" . $imgName . ".php");
?>