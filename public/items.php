<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function convertToTitleCase($input) 
{
	$words = explode("_", $input);
	$formattedWords = array_map("ucwords", $words);
	return implode(" ", $formattedWords);
}

if (isset($_SESSION["userId"])) 
{
	$sessionLoggeduserId = $_SESSION["userId"];

	$dbResultLists = dbQuery("SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= ?", [$sessionLoggeduserId]);
}

$resultItems = dbQuery("SELECT items.item_id, items.item_name, categories.category_name, items.size FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC LIMIT 6;");

$template = $twig->load("items.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"lists"    => $dbResultLists ?? NULL,
	"items"    => $resultItems,
]));

