<?php
function invalidUid($name) {
	$result = true;

	if (preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		$result = false;
	}
	else if ($name = "admin") {
		$result = false;
	}

	return $result;
}

function invalidEmail($email) {
	$result = true;

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = false;
	}

	return $result;
}

function passMatch($pass, $r_password) {
	$result = false;

	if ($pass != $r_password) {
		$result = true;
	}

	return $result;
}

function uidExists($name) {
     global $db;

	$result = false;
	$dbResult = dbQuery("SELECT * FROM users WHERE users.username = ?;", [$name]);
	
	if (sizeof($dbResult) > 0) {
		$result = true;
	}
	
	return $result;
	
}

function emailExists($email) {
     global $db;

	$result = false;
	$dbResult = dbQuery("SELECT * FROM users WHERE users.username = ?;", [$name]);
	$result = false;
	$dbResult = dbQuery("SELECT * FROM users WHERE email = ?", [$email]);
	
	if (sizeof($dbResult) > 0) {
		$result = true;
	}
	
	return $result;
}

function createUser($name, $pass, $email) {
     global $db;

	$dbResult = dbQuery("INSERT INTO users (username, password, email) VALUES (?, ?, ?)", [$name, $hashedPass, $email]);
 
	if ($dbResult === NULL) {
		header("location: ./../signup.php?error=none");
	} else {
		header("location: ./../signup.php?error=stmtfailed");
	}
}

function loginUser($name, $pass) {
     global $db;

	$uidExists = uidExists($name);

	if ($uidExists === false) {
		header("location: ./../login.php?error=wronglogin");
		exit();
	}

	$dbResult = dbQuery("SELECT password FROM users WHERE username = ?", [$name]);
	if (sizeof($dbResult) === 1) $passHash = $dbResult["password"];
	$checkPass = password_verify($pass, $passHash);

	if ($checkPass === false) {
	    header("location: ./../login.php?error=wrongpass");
	    exit();
	}
	else if($checkPass === true)  {
		session_start();
		$_SESSION["userId"] = $name;
		header("location: ./../index.php");
		exit();
	}
}
