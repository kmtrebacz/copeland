<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";

$conn = dbConnect();

function convertToTitleCase($input){
	$words = explode("_", $input);
	$formattedWords = array_map("ucwords", $words);
	return implode(" ", $formattedWords);
}

if (isset($_SESSION["userId"])) {
	$sessionLoggeduserId = $_SESSION["userId"];

	$resultLists = dbQuery($conn, "SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= '$sessionLoggeduserId';");
	$lists = "";
}

$resultItems = dbQuery($conn, "SELECT items.item_id, items.item_name, categories.category_name, items.size, items.items_view_count FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC LIMIT 6;");


$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);
$template = $twig->load("home.twig");

print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"lists"    => isset($resultLists) ? $resultLists : NULL,
	"items"    => $resultItems,
]));
