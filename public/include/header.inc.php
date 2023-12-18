<?php
require_once "./include/db_connection.inc.php";

session_start();
$db = dbConnect();

function errorHandler($errors) 
{
	if (isset($_GET["error"])) 
	{
		$errorMessage = $_GET["error"];
		return $errors[$errorMessage];
	}
}

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);