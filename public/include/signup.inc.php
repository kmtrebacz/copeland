<?php
require_once "./db_connection.inc.php";
require_once "./functions.inc.php";

$db = dbConnect();

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] === "POST") 
{
	$name       = $_POST["name"];
	$pass       = $_POST["pwd"];
	$r_password = $_POST["r_pwd"];
	$email      = $_POST["email"];

	if (invalidUid($name)) 
	{
		header("location: ./../signup.php?error=invaliduid");
		exit();
	}

	if (invalidEmail($email)) 
	{
		header("location: ./../signup.php?error=invalidemail");
		exit();
	}

	if (passMatch($pass, $r_password)) 
	{
		header("location: ./../signup.php?error=passwordsdontmatch");
		exit();
	}

	if (uidExists($name)) 
	{
		header("location: ./../signup.php?error=usernametaken");
		exit();
	}

	if (emailExists($name, $email)) 
	{
		header("location: ./../signup.php?error=emailwasused");
		exit();
	}

	createUser($name, $pass, $email);
}
else 
{
    	header("location: ./../signup.php");
}
?>