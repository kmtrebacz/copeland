<?php
session_start();

if (isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function errorHandler() {
	if (isset($_GET["error"])) {
		switch (isset($_GET["error"])) {
			case $_GET["error"] == "invaliduid":
				return "Choose a proper username!";

			case $_GET["error"] == "invalidemail":
				return "Choose a proper email!";

			case $_GET["error"] == "passwordsdontmatch":
				return "Passwords don't match!";

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

$template = $twig->load("signup.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"error"    => errorHandler(),
]));
