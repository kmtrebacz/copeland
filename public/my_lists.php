<?php
session_start();

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$userId = $_SESSION["userId"];

$resultItems = $conn->query("SELECT list_name, is_public FROM lists WHERE user_id = '$userId';");

$template = $twig->load("my_lists.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"lists"    => $resultItems,
]));