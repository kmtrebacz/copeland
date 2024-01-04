<?php
require_once __DIR__ . "/../db_connection.inc.php";
require_once __DIR__ . "/user_functions.inc.php";

$db = dbConnect();

if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
	$name = $_POST["name"];
	$pass = $_POST["password"];

	loginUser($name, $pass);
}
else 
{
	header("location: ".__DIR__."/../../public/login.php");
	exit();
}
