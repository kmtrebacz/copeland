<?php
session_start();

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$userId = $_SESSION["userId"];

$resultLists = dbQuery("SELECT lists.list_id, lists.list_name, lists.is_public FROM lists WHERE lists.user_id = (SELECT users.user_id FROM users WHERE users.username = ?)", [$userId]);

var_dump($resultLists);

$template = $twig->load("my_lists.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"lists"    => $resultLists,
]));