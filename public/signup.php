<?php
session_start();

if (!isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./php_inc/db_functions.inc.php";

function errorHandler(){
	if (isset($_GET["error"])) {
		switch (isset($_GET["error"])) {
			case $_GET["error"] == "invaliduid":
				return "Choose a proper username!";

			case $_GET["error"] == "invaliduid":
				return "Choose a proper email!";

			case $_GET["error"] == "passwordsdontmatch":
				return "This username is already associated with an existing account!";

			case $_GET["error"] == "usernametaken":
				return "Choose a proper username!";

			case $_GET["error"] == "emailwasused":
				return "This email address is already associated with an existing account!";

			case $_GET["error"] == "stmtfaild":
				return "Somethink went wrong, try again!";

			case $_GET["error"] == "none":
				return "You have signed up!";
		}
	}
}

$loader = new \Twig\Loader\FilesystemLoader("./../templates/");
$twig = new \Twig\Environment($loader, [
	"cache" => "./../cache",
]);
$template = $twig->load("my_profile.twig");

print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"error"    => errorHandler(),
]));
