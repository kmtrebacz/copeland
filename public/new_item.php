<?php
session_start();

require_once "./include/header.inc.php";

$template = $twig->load("new_item.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
]));
