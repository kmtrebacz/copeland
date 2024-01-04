<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	$getListId = $_GET["list_id"];

     $dbResultListInfo = dbQuery("SELECT lists.list_id, lists.list_name, lists.is_public FROM lists WHERE lists.list_id = ?", [$getListId], true);
     $dbResultItemsInList = dbQuery("SELECT items.item_id, items.item_name, categories.category_name, items.size, items.img_src FROM lists JOIN list_items ON list_items.list_id = lists.list_id JOIN items ON items.item_id = list_items.item_id JOIN categories ON categories.category_id = items.category_id WHERE lists.list_id = ?", [$getListId]);

	$template = $twig->load("list.twig");
	print($template->render([
          "isLogged"    => isset($_SESSION["userId"]),
          "listId"      => $dbResultListInfo["list_id"],
		"listName"    => $dbResultListInfo["list_name"],
          "isPublic"    => $dbResultListInfo["is_public"],
          "itemsInList" => $dbResultItemsInList ?? NULL,
	]));
}
