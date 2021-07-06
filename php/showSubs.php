<?php
	session_start();
	$_SESSION['mainContent'] = 'subs';
	header('Location: ../index.php');
?>