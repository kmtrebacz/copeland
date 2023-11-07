<?php
require_once "./include/db_connection.inc.php";

$conn = dbConnect();

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);