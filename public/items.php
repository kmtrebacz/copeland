<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

if (isset($_SESSION["userId"])) 
{
	$sessionLoggedUserId = $_SESSION["userId"];

	$dbResultLists = dbQuery("SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= ?", [$sessionLoggedUserId]);
}

$dbResultItems = dbQuery("SELECT items.item_id, items.item_name, categories.category_name, items.size, items.img_src FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC;");

$template = $twig->load("items.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"lists"    => $dbResultLists ?? NULL,
	"items"    => $dbResultItems ?? NULL,
]));

