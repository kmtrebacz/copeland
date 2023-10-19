<?php
require_once(__DIR__ . "/vendor/autoload.php");

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
		"cache" => "./../cache",
]);
$template = $twig->load("about.twig");

print($template->render(["content" => "test about"]));
