<?php
session_start();

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$template = $twig->load("new_item.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
]));
