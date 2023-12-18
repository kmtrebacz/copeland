<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function increaseViewCount($value, $id) 
{
	global $db;
	$value = (int)$value + 1;
	dbQuery("UPDATE items SET items.items_view_count = ? WHERE items.item_id = ?", [$value, $id]);
}

if ($_SERVER["REQUEST_METHOD"] ===  "GET") 
{
	$getItemId = $_GET["item_id"];

	if (isset($_SESSION["userId"])) 
	{
		$sessionLoggeduserId = $_SESSION["userId"];
	
		$dbResultLists = dbQuery("SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= ?", [$sessionLoggeduserId]);
	}

	$resultItems = dbQuery("SELECT items.item_name, categories.category_name, items.size FROM items JOIN categories ON categories.category_id = items.category_id WHERE items.item_id = ? LIMIT 1;", [$getItemId], true);

	$resultItemName     = $resultItems["item_name"];
	$resultItemCategory = $resultItems["category_name"];
	$resultItemSize     = $resultItems["size"];
	$resultImgSrc       = $resultItems["img_src"];

	$template = $twig->load("item.twig");
	print($template->render([
		"isLogged"   => isset($_SESSION["userId"]),
		"lists"      => $dbResultLists ?? NULL,
		"name"       => $resultItemName,
		"category"   => $resultItemCategory,
		"size"       => $resultItemSize,
		"imgIrc"    => $resultImgSrc,
		"itemId"     => $_SESSION["userId"] ?? false,
	]));

	$sqlViewCountResult = dbQuery("SELECT items.items_view_count FROM items WHERE items.item_name = ? AND items.size = ? LIMIT 1", [$resultItemName, $resultItemSize], true);
	increaseViewCount($sqlViewCountResult["items_view_count"], $getItemId);
}
?>
