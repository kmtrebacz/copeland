<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

if (!isset($_SESSION["userId"])) header("location: /index.php");

$userId = $_SESSION["userId"];

$dbResultUserInfo = dbQuery("SELECT * FROM users WHERE username = ?", [$userId], true);

$template = $twig->load("my_profile.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"info"     => $dbResultUserInfo ?? NULL,
]));
