<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

if (!isset($_SESSION["userId"])) header("location: /index.php");

$userId = $_SESSION["userId"];

$dbResultLists = dbQuery("SELECT lists.list_id, lists.list_name, lists.is_public FROM lists WHERE lists.user_id = (SELECT users.user_id FROM users WHERE users.username = ?)", [$userId]);

$template = $twig->load("my_lists.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"lists"    => $dbResultLists ?? NULL,
]));
