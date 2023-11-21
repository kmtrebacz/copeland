<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$getItemId = $_GET["item_id"];

	if (isset($_SESSION["userId"])) {
		$sessionLoggeduserId = $_SESSION["userId"];
	
		$resultLists = $conn->query("SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= '$sessionLoggeduserId';");
	}

	$resultItems = $conn->query("SELECT items.item_name, categories.category_name, items.size FROM items JOIN categories ON categories.category_id = items.category_id WHERE items.item_id = '$getItemId' LIMIT 1;")->fetch_assoc();

	$resultItemName     = $resultItems["item_name"];
	$resultItemCategory = $resultItems["category_name"];
	$resultItemSize     = $resultItems["size"];

	$template = $twig->load("item.twig");
	print($template->render([
		"isLogged"   => isset($_SESSION["userId"]) ? true : false,
		"lists"      => isset($resultLists) ? $resultLists : NULL,
		"name"       => $resultItemName,
		"category"   => $resultItemCategory,
		"size"       => $resultItemSize,
		"itemId"     => isset($_SESSION["userId"]) ? $_SESSION["userId"] : false,
	]));

	$sqlViewCount = "SELECT items.items_view_count FROM items WHERE items.item_name = '$resultItemName' AND items.size = '$resultItemSize' LIMIT 1;";
	$sqlViewCountResult = $conn->query($sqlViewCount);
	$sqlViewCountResult = mysqli_fetch_row($sqlViewCountResult);

	$viewCountAdded = (int)$sqlViewCountResult[0] + 1;
	$sqlViewCountUpdate = "UPDATE items SET items.items_view_count=$viewCountAdded WHERE items.item_name = '$resultItemName' AND items.size = '$resultItemSize'";
	$conn->query($sqlViewCountUpdate);
}
?>