<?php
	session_start();
	$_SESSION['mainContent'] = 'all';
	header('Location: ../index.php');
?>