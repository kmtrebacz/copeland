<?php
require_once __DIR__ . "/../db_connection.inc.php";

session_start();
$db = dbConnect();

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") 
{
	$postListName      = $_POST["list_name"];
	$postListPublic    = $_POST["list_public"] ?? NULL;
	$listPublicChecked = 0;
	$userId            = $_SESSION["userId"];

	if ($postListPublic == "on") 
	{
		$listPublicChecked = 1;
	}

	$dbResult = dbQuery("SELECT users.user_id FROM users WHERE users.username = ?;", [$userId], true);
	$resultUserId = $dbResult["user_id"];
	$dbResult = dbQuery("INSERT INTO `lists`(`user_id`, `list_name`, `is_public`) VALUES (?, ?, ?);", [$resultUserId, $postListName, $listPublicChecked]);

	header("location: ".__DIR__."/../../public/create_list.php?error=none");
}