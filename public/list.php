<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

if (isset($_GET["submit"]) && $_SERVER["REQUEST_METHOD"] == "GET") 
{
	$getListName     = $_GET["list_name"];
	$getListIsPublic = $_GET["is_public"];

	$template = $twig->load("list.twig");
	print($template->render([
		"isLogged"      => isset($_SESSION["userId"]),
		'listName'      => $getListName,
		'isListPrivate' => $getListIsPublic,
	]));
}