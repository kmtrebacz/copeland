<?php
if (!isset($_SESSION["userid"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";


$conn = dbConnect();
$userId = $_SESSION["userid"];

$result = dbQuery($conn, "SELECT * FROM users WHERE username = $userId");


$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);
$template = $twig->load("my_profile.twig");

print($template->render([
	"user" => $result,
]));