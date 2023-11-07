<?php
session_start();

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$userId = $_SESSION["userId"];

$result = $conn->query("SELECT * FROM users WHERE username = '$userId';");

$template = $twig->load("my_profile.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"users"    => $result,
]));