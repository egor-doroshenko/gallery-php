<?php
session_start();

require_once 'dbConnect.php';

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];
$profilePath = 'profiles/' . $login . '.php';

$sql = "SELECT * FROM users WHERE `login` = '$login'";
$loginCheck = mysqli_query($connect, $sql);
$loginCheck = mysqli_num_rows($loginCheck);
$sql = "SELECT * FROM users WHERE `email` = '$email'";
$emailCheck = mysqli_query($connect, $sql);
$emailCheck = mysqli_num_rows($emailCheck);

if ($loginCheck > 0) {
	$_SESSION['formMessage'] = "Login is aleready used! Please, try another.";
	header('Location: ../register.php');
} elseif ($emailCheck > 0) {
	$_SESSION['formMessage'] = "Email is aleready used! Please, try another.";
	header('Location: ../register.php');
} else {
	if ($password === $passwordConfirm) {
		$avatarPath = 'avatars/' . time() . $_FILES['avatar']['name'];	
		if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../usersImg/' . $avatarPath)) {
			$_SESSION['formMessage'] = "Avatar uploading error! Please, try again or use different image.";
			header('Location: ../register.php');
		}

		$password = md5($password);
		mysqli_query($connect, "INSERT INTO `users` (`login`, `email`, `password`, `avatar`, `profile`) VALUES ('$login', '$email', '$password', '$avatarPath', '$profilePath')");
		$profilePhp = fopen("$profilePath", w);
		fwrite($profilePhp, "<?php \n");
		fwrite($profilePhp, '$login = "' . $login . '";' . "\n");
		fwrite($profilePhp, '$avatarPath = "' . $avatarPath . '";' . "\n");
		fwrite($profilePhp, "include ('../viewProfile.php');\n");
		fwrite($profilePhp, '$str = htmlentities(file_get_contents("../viewProfile.php"));' . "\n");
		fwrite($profilePhp, '?>');
		fclose($profilePhp);
		$_SESSION['formMessage'] = "You were successfully registered!";
		header('Location: ../login.php');


	} else {
		$_SESSION['formMessage'] = "Passwords missmatch!";
		header('Location: ../register.php');
	}
}