<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	$getListId = $_GET["list_id"];

     $listInfoDbResult = dbQuery("SELECT lists.list_name, lists.is_public FROM lists WHERE lists.list_id = ?", [$getListId], true);
     $itemsInListDbResult=  dbQuery("SELECT items.item_id, items.item_name, categories.category_name, items.size, items.img_src FROM lists JOIN list_items ON list_items.list_id = lists.list_id JOIN items ON items.item_id = list_items.item_id JOIN categories ON categories.category_id = items.category_id WHERE lists.list_id = ?", [$getListId]);

	$template = $twig->load("list.twig");
	print($template->render([
		"isLogged"    => isset($_SESSION["userId"]),
		"listName"    => $listInfoDbResult["list_name"],
          "isPublic"    => $listInfoDbResult["is_public"],
          "itemsInList" => $itemsInListDbResult ?? NULL,
	]));
}
