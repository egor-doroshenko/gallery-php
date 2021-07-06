<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbName = "new_gallery";

$connect = mysqli_connect($servername, $username, $password, $dbName);

if (!$connect) {
	die('Error! Not connected to database...');
}
?>