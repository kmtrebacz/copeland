<?php
require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";


$conn = dbConnect();
session_start();

$sessionLoggedUserId = $_SESSION["userid"];

function convertToTitleCase($input){
	$words = explode("_", $input);
	$formattedWords = array_map("ucwords", $words);
	return implode(" ", $formattedWords);
}

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

$resultItems = dbQuery($conn, "SELECT items.item_id, items.item_name, categories.category_name, items.size, items.items_view_count FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC LIMIT 6;");


$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
    "cache" => "./../cache",
]);
$template = $twig->load("home.twig");

print($template->render([
	"items" => $resultItems,
]));