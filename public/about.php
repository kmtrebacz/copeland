<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../private/header.inc.php";

$template = $twig->load("about.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"content"  => "test about",
]));
