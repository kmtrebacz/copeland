<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require_once "./db_connection.inc.php";
	require_once "./functions.inc.php";

	$conn = dbConnect();

	$name = $_POST["name"];
	$pass = $_POST["password"];

	loginUser($conn, $name, $pass);
}
else {
	header("location: ./../login.php");
	exit();
}
