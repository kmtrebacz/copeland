<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "copeland";

function dbConnect() {
	global $servername, $username, $password, $database;
	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$conn->set_charset("utf8");

	return $conn;
}