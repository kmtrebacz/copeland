<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass = $_POST['pwd'];
    $r_password = $_POST['r_pwd'];
    $email = $_POST['email'];

    require_once './../../includes/db_connection.php';
    require_once './functions.inc.php';

    if (invalidUid($name) === true) {
        header("location: ./../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) === true) {
        header("location: ./../signup.php?error=invalidemail");
        exit();
    }
    if (passMatch($pass, $r_password) === true) {
        header("location: ./../signup.php?error=passwordsdontmatch");
        exit();
    }
    if (uidExists($name, $email, $conn) === true) {
        header("location: ./../signup.php?error=usernametaken");
        exit();
    }

    createUser($name, $pass, $email, $conn);
}
else {
    header("location: ./../signup.php");
}
?>