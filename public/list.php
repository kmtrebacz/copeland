<?php
require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";


$conn = dbConnect();

		
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$getListName = $_GET["list_name"];
	$getListIsPublic = $_GET["is_public"];

	$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
	$twig = new \Twig\Environment($loader, [
		"cache" => "./../cache",
	]);
	$template = $twig->load("list.twig");

	print($template->render([
		'listName'      => $getListName,
		'isListPrivate' => $getListIsPublic,
	]));
}