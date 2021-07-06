<?php
session_start();
require_once 'dbConnect.php';

$user = $_SESSION['user']['login'];
$subName = $_POST['subName'];
$subAction = $_POST['subAction'];

if ($subAction === 'subscribe') {
	$sql = "INSERT INTO subs (`user`, `sub`) VALUES ('$user', '$subName')";
} elseif ($subAction === 'unsubscribe') {
	$sql = "DELETE FROM subs WHERE `user` = '$user' && `sub` = '$subName'";
}


mysqli_query($connect, $sql)
	or die(mysqli_error($connect));

$_SESSION['goBack'] = $subName;
header('Location: profiles/' . $subName . '.php');
?>