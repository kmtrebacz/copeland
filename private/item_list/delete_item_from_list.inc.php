<?php
require_once __DIR__ . "/../db_connection.inc.php";
require_once __DIR__ . "/item_list_functions.inc.php";

session_start();
$db = dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
     $getListId = $_GET["list_id"];
     $getItemId = $_GET["item_id"];

     if (checkUser($getListId))
     {
          dbQuery("DELETE FROM list_items WHERE list_items.list_id = ? AND list_items.item_id = ?",[$getListId, $getItemId]);
          header("location: ".__DIR__."/../../public/list.php?list_id=$getItemId");
	     exit();
     }
}
