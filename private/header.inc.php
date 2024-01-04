<?php
require_once __DIR__ . "/db_connection.inc.php";

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

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => __DIR__ . "/../cache/",
]);