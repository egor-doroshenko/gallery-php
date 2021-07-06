<?php
session_start();
require_once 'dbConnect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$loginCheck = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");

if (mysqli_num_rows($loginCheck) > 0) {
	$userData = mysqli_fetch_assoc($loginCheck);
	if ($password === $userData['password']) {
		$_SESSION['user'] = [
			"id" => $userData['id'],
			"login" => $userData['login'],
			"email" => $userData['email'],
			"avatar" => $userData['avatar']
		];
		header('Location: ../profile.php');
	} else {
		$_SESSION['formMessage'] = "Wrong password! Please, check it.";
		header('Location: ../login.php');
	}
} else {
	$_SESSION['formMessage'] = "Wrong login! Please, check it.";
	header('Location: ../login.php');
}