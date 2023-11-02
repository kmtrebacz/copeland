<?php
session_start();

require_once "./../vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
     "cache" => "./../cache",
]);
$template = $twig->load("create_list.twig");

print($template->render([
     "isLogged" => isset($_SESSION["userId"]) ? true : false,
]));
