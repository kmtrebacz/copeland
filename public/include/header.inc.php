<?php
require_once "./include/db_connection.inc.php";

$db = dbConnect();

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);