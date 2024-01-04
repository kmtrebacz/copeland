<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

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
		$sessionLoggedUserId = $_SESSION["userId"];
	
		$dbResultLists = dbQuery("SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= ?", [$sessionLoggedUserId]);
	}

	$dbResultItem = dbQuery("SELECT items.item_name, categories.category_name, items.size, items.img_src FROM items JOIN categories ON categories.category_id = items.category_id WHERE items.item_id = ? LIMIT 1;", [$getItemId], true);

	$dbResultItemName     = $dbResultItem["item_name"];
	$dbResultItemCategory = $dbResultItem["category_name"];
	$dbResultItemSize     = $dbResultItem["size"];
	$dbResultItemImgSrc   = $dbResultItem["img_src"];

	$template = $twig->load("item.twig");
	print($template->render([
		"isLogged"   => isset($_SESSION["userId"]),
		"lists"      => $dbResultLists ?? NULL,
		"name"       => $dbResultItemName,
		"category"   => $dbResultItemCategory,
		"size"       => $dbResultItemSize,
		"imgSrc"     => $dbResultItemImgSrc,
		"itemId"     => $_SESSION["userId"] ?? false,
	]));

	$sqlViewCountResult = dbQuery("SELECT items.items_view_count FROM items WHERE items.item_name = ? AND items.size = ? LIMIT 1", [$dbResultItemName, $dbResultItemSize], true);
	increaseViewCount($sqlViewCountResult["items_view_count"], $getItemId);
}
?>
