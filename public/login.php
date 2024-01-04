<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

if (isset($_SESSION["userId"])) header("location: ./index.php");

$errors = [
	"wronglogin" => "Wrong login!",
	"wrongpass"  => "Wrong password!",
	"none"       => "You have logged in!",
];

$template = $twig->load("login.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"error"    => errorHandler($errors),
]));
