<?php
require_once "./db_connection.inc.php";

session_start();
$db = dbConnect();

function checkUser($listId): bool
{
     $dbResult = dbQuery("SELECT users.username FROM lists JOIN users ON users.user_id = lists.user_id WHERE lists.list_id = ? LIMIT 1;", [$listId], true);

     if ($dbResult["username"] == $_SESSION["userId"]) return true;
     else return false;
}

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
          if (checkUser($value)) 
          {
               $result = dbQuery("INSERT INTO list_items(list_id, item_id) VALUES (?, ?)", [$value, $itemId]);
          }
	}

	header("location: ./../index.php?error=none");
	exit();
}
