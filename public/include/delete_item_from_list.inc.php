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
     $getListId = $_GET["list_id"];
     $getItemId = $_GET["item_id"];

     if (checkUser($getListId))
     {
          dbQuery("DELETE FROM list_items WHERE list_items.list_id = ? AND list_items.item_id = ?",[$getListId, $getItemId]);
          header("location: ./../list.php?list_id=$getItemId");
	     exit();
     }
}
