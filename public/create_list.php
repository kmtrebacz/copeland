<?php
session_start();

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

function errorHandler() {
	if (isset($_GET["error"])) {
		switch (isset($_GET["error"])) {
			case $_GET["error"] == "stmtfailed":
				return "Somethink goes wrong! Try again later.";

			case $_GET["error"] == "none":
				return "List has been created!";
		}
	}
}

$template = $twig->load("create_list.twig");
print($template->render([
     "isLogged" => isset($_SESSION["userId"]),
     "error"    => errorHandler(),
]));
