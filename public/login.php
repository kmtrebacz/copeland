<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function errorHandler(){
	if (isset($_GET["error"])) {
		switch (isset($_GET["error"])) {
			case $_GET["error"] == "wronglogin":
				return "Wrong login!";

			case $_GET["error"] == "wrongpass":
				return "Wrong password!";

			case $_GET["error"] == "none":
				return "You have logged in!";
		}
	}
}

$template = $twig->load("login.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]) ? true : false,
	"error"    => errorHandler(),
]));