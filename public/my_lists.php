<?php
if (!isset($_SESSION["userid"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";


$conn = dbConnect();
$userId = $_SESSION["userid"];

$resultItems = dbQuery($conn, "SELECT list_name, is_public FROM lists WHERE user_id = $userId;");


$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);
$template = $twig->load("my_lists.twig");

print($template->render([
	"lists" => $resultItems,
]));