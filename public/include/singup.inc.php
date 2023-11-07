<?php
if (isset($_POST["submit"])) {
	require_once "./db_connection.inc.php";
	require_once "./functions.inc.php";

	$conn = dbConnect();

	$name       = $_POST["name"];
	$pass       = $_POST["pwd"];
	$r_password = $_POST["r_pwd"];
	$email      = $_POST["email"];

	if (invalidUid($name) === true) {
		header("location: ./../signup.php?error=invaliduid");
		exit();
	}
	if (invalidEmail($email) === true) {
		header("location: ./../signup.php?error=invalidemail");
		exit();
	}
	if (passMatch($pass, $r_password) === true) {
		header("location: ./../signup.php?error=passwordsdontmatch");
		exit();
	}
	if (uidExists($name, $conn) === true) {
		header("location: ./../signup.php?error=usernametaken");
		exit();
	}
	if (emailExists($email, $conn) === true) {
		header("location: ./../signup.php?error=emailwasused");
		exit();
	}

	createUser($name, $pass, $email, $conn);
}
else {
    	header("location: ./../signup.php");
}
?>