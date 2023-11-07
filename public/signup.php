<?php
session_start();

if (isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function errorHandler(){
	if (isset($_POST["error"])) {
		switch (isset($_POST["error"])) {
			case $_POST["error"] == "invaliduid":
				return "Choose a proper username!";

			case $_POST["error"] == "invaliduid":
				return "Choose a proper email!";

			case $_POST["error"] == "passwordsdontmatch":
				return "This username is already associated with an existing account!";

			case $_POST["error"] == "usernametaken":
				return "Choose a proper username!";

			case $_POST["error"] == "emailwasused":
				return "This email address is already associated with an existing account!";

			case $_POST["error"] == "stmtfaild":
				return "Somethink went wrong, try again!";

			case $_POST["error"] == "none":
				return "You have signed up!";
		}
	}
}

$template = $twig->load("signup.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"error"    => errorHandler(),
]));
