<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$template = $twig->load("about.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"content"  => "test about",
]));
