<?php
session_start();

require_once "./db_connection.inc.php";

$conn = dbConnect();

$list_name           = $_POST["list_name"];
$list_public         = $_POST["list_public"];
$list_public_checked = 0;
$user_id             = $_SESSION["userId"];

if (isset($_POST["list_public"]) && $_POST["list_public"] == "on") {
	$list_public_checked = 1;
}

$sql    = "SELECT user_id FROM users WHERE username = '$user_id';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row     = $result->fetch_assoc();
	$user_id = $row["user_id"];
}

$sql = "INSERT INTO `lists`(`user_id`, `list_name`, `is_public`) VALUES ('$user_id', '$list_name', '$list_public_checked');";

$stmt = $conn->prepare($sql);

if (!$stmt) {
	die("Error preparing statement: " . $conn->error);
}

if ($stmt->execute()) {
	header("location: ./../create_list.php?error=none");
} else {
	header("location: ./../create_list.php?error=stmtfailed");
}

$stmt->close();
$conn->close();

exit();
