<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$errors = [
	"wronglogin" => "Wrong login!",
	"wrongpass"  => "Wrong password!",
	"none"       => "You have logged in!",
];

function errorHandler() 
{
     global $errors;

	if (isset($_GET["error"])) 
	{
		$errorMessage = $_GET["error"];
		return $errors[$errorMessage];
	}
}

$template = $twig->load("login.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"error"    => errorHandler(),
]));
