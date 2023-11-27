<?php
session_start();

require_once "./db_connection.inc.php";

$db = dbConnect();

$postListName      = $_POST["list_name"];
$postListPublic    = $_POST["list_public"];
$listPublicChecked = 0;
$userId            = $_SESSION["userId"];

if (isset($_POST["list_public"]) && $_POST["list_public"] == "on") {
	$listPublicChecked = 1;
}

$dbResult = dbQuery("SELECT user_id FROM users WHERE username = ?;", [$userId]);

$resultUserId = $dbResult["user_id"];

$dbResult = dbQuery("INSERT INTO `lists`(`user_id`, `list_name`, `is_public`) VALUES (?, ?, ?);", [$resultUserId, $postListName, $listPublicChecked]);

if ($dbResult === NULL) {
	header("location: ./../create_list.php?error=none");
} else {
	header("location: ./../create_list.php?error=stmtfailed");
}

exit();