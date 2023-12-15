<?php
function invalidUid($name) 
{
	if (preg_match("/^[a-zA-Z0-9]{2,50}$/", $name)) 
	{
		$result = false;
	}
	else if ($name = "admin") 
	{
		$result = true;
	}

	return $result;
}

function invalidEmail($email) 
{
	$result = true;

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$result = false;
	}

	return $result;
}

function passMatch($pass, $r_password) 
{
	$result = false;

	if ($pass != $r_password) 
	{
		$result = true;
	}

	return $result;
}

function uidExists($name) 
{
     global $db;

	$dbResult = dbQuery("SELECT * FROM users WHERE users.username = ?;", [$name]);
	
	$dbResult === NULL ? $result = false: $result = true;
	
	return $result;
}

function emailExists($name, $email) 
{
     global $db;

	$dbResult = dbQuery("SELECT * FROM users WHERE email = ?", [$email]);
	
	$dbResult === NULL ? $result = false: $result = true;
	
	return $result;
}

function createUser($name, $pass, $email) 
{
     global $db;

	$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

	$dbResult = dbQuery("INSERT INTO users (username, password, email) VALUES (?, ?, ?)", [$name, $hashedPass, $email]);
 
	if ($dbResult === NULL) header("location: ./../signup.php?error=none");
}

function loginUser($name, $pass) 
{
     global $db;

	$uidExists = uidExists($name);

	if ($uidExists === false) 
	{
		header("location: ./../login.php?error=wronglogin");
		exit();
	}

     $dbResult = dbQuery("SELECT password FROM users WHERE username = ? LIMIT 1", [$name], true);
	$passHash = $dbResult["password"];
	$checkPass = password_verify($pass, $passHash);

     
	if($checkPass)  
	{
		session_start();
		$_SESSION["userId"] = $name;
		header("location: ./../index.php");
		exit();
     }
     else
	{
	    header("location: ./../login.php?error=wrongpass");
	    exit();
	}
}
