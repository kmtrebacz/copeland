<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	$getListId = $_GET["list_id"];

	$dbResult = dbQuery("SELECT lists.list_name, lists.is_public FROM lists WHERE lists.list_id = ?", [$getListId], true);

	$template = $twig->load("list.twig");
	print($template->render([
		"isLogged" => isset($_SESSION["userId"]),
		"listName" => $dbResult["list_name"],
		"isPublic" => $dbResult["is_public"],
	]));
}