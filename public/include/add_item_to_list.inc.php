<?php
require_once "./db_connection.inc.php";

session_start();
$db = dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	$listsId = [];
	$itemId = $_GET["item_id"];

	print("SELECTED ITEM: $itemId <br>");

	foreach ($_GET as $paramName => $paramValue) 
	{
		if (strpos($paramName, "item_name_") === 0) 
		{
			$item = substr($paramName, strlen("item_name_"));

			print("SELECTED LIST: $item (ID: $paramValue)<br>");
			array_push($listsId, $paramValue);
		}
	}

	//var_dump($listsId);

	foreach ($listsId as $key => $value) 
	{
		$result = dbQuery("INSERT INTO list_items(list_id, item_id) VALUES (?, ?)", [$value, $itemId]);
	}

	header("location: ./../index.php?error=none");
	exit();
}
