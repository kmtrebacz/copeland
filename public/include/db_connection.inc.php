<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "copeland";

function dbConnect() {
	global $servername, $username, $password, $database;

	try {
		$db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $err) {
		die("Connection failed: " . $err->getMessage());
     }

     return $db;
}

function dbQuery($sql, $params = []) {
	global $db;

	try {
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
	}
	catch (PDOException $e) {
		die("Preparing the query failed: " . $e->getMessage());
	}

	if($stmt->rowCount() === 1) {
		return $stmt->fetch(PDO::FETCH_ASSOC);
	} else if($stmt->rowCount() > 1) {
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} else {
		return null;
	}
}
