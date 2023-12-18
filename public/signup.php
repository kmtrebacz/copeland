<?php
if (isset($_SESSION["userId"])) header("location: ./../index.php");

require_once "./../vendor/autoload.php";
require_once "./include/header.inc.php";

$errors = [
	"invaliduid"         => "Choose a proper email!",
	"invalidemail"       => "Choose a proper email!",
	"passwordsdontmatch" => "Passwords don't match!",
	"usernametaken"      => "Username have was taken!",
	"emailwasused"       => "This email address is already associated with an existing account!",
	"stmtfaild"          => "Somethink went wrong, try again!",
	"none"               => "You have signed up!",
];

$template = $twig->load("signup.twig");
print($template->render([
	"isLogged" => isset($_SESSION["userId"]),
	"error"    => errorHandler($errors),
]));
