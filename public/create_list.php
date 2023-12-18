<?php
require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$errors = [
	"stmtfailed" => "Somethink goes wrong! Try again later.",
	"none"       => "List has been created!",
];

$template = $twig->load("create_list.twig");
print($template->render([
     "isLogged" => isset($_SESSION["userId"]),
     "error"    => errorHandler($errors),
]));
