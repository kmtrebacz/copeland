<?php
require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";


$conn = dbConnect();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$getItemName = $_GET["item_name"];
	$getItemCategory = $_GET["category_name"];
	$getItemSize = $_GET["size"];
	$getItemViewCount = $_GET["view_count"];

	if (isset($_SESSION["userid"])) {
		

		$resultLists = dbQuery($conn, "SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username= '$sessionLoggedUserId';");
		$lists = "";
		if ($resultLists->num_rows > 0) {
			while ($row = $resultLists->fetch_assoc()) {
				$rowListName = $row["list_name"];
				$rowListId = $row["list_id"];
	
				$lists .= "<input type='checkbox' name='item_name_$rowListName' value='$rowListId'>  <label>$rowListName</label><br>";
			}
			$lists .= "<input type='submit' class='mt-2 btn btn-primary' value='Add to list'>";
		}
	}


	$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
	$twig = new \Twig\Environment($loader, [
		"cache" => "./../cache",
	]);
	$template = $twig->load("item.twig");

	print($template->render([
		"name" => $_GET["item_name"],
		"category" => $_GET["category_name"],
		"size" => $_GET["size"],
		"view_count" => $_GET["view_count"],
	]));

	$viewCountAdded = (int)$_GET["view_count"] + 1;

	$sqlViewCount = "UPDATE items SET items.items_view_count=$viewCountAdded WHERE items.item_name = '$getItemName' AND items.size = '$getItemSize'";

	dbQuery($conn, $sqlViewCount);
			
	dbClose($conn);
}
?>