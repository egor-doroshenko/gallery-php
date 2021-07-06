<?php
session_start();
require_once 'dbConnect.php';

$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];
$login = $_SESSION['user']['login'];

if ($email && ($email != NULL) )  {
	mysqli_query($connect, "UPDATE `users` SET `email` = '$email' WHERE `login` = '$login'");
	$_SESSION['user']['email'] = $email;
	$emailUpdate = true;
} else {
	$_SESSION['formMessage'] = "Invalid email! Please, try again.";
	header('Location: ../profileEdit.php');
}

if ($password === $passwordConfirm) {
	if ($password && ($password != NULL) ) {
		$password = md5($password);
		$sql = "UPDATE `users` SET `password` = '$password' WHERE `login` = '$login'";
		mysqli_query($connect, $sql);
		$sql = "UPDATE `users` SET `passwordConfirm` = '$passwordConfirm' WHERE `login` = '$login'";
		mysqli_query($connect, $sql);
		$passwordUpdate = true;
} else {
	if ($password != $passwordConfirm) {
		$_SESSION['formMessage'] = "Passwords missmatch!";
		header('Location: ../profileEdit.php');
	}
	
}
}

if ( ($emailUpdate == true) && ($passwordUpdate == true) ) {
	$_SESSION['formMessage'] = "Email and password edited!";
	header('Location: ../profileEdit.php');
} elseif ($emailUpdate == true) {
	$_SESSION['formMessage'] = "Email edited!";
	header('Location: ../profileEdit.php');
} elseif ($passwordUpdate == true) {
	$_SESSION['formMessage'] = "Password edited!";
	header('Location: ../profileEdit.php');
}



?>