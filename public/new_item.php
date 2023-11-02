<?php
session_start();

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);
$template = $twig->load("new_item.twig");

print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
]));
