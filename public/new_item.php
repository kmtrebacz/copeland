<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

$template = $twig->load("new_item.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
]));
