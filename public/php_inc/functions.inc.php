<?php
function invalidUid($name) {
     $result = true;
     if (preg_match("/^[a-zA-Z0-9]*$/", $name)) {
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

function uidExists($name, $conn) {
     $result = false;
     $sql = "SELECT * FROM users WHERE username = '$name'";

     $result = $conn->query($sql);
     
     if ($result->num_rows > 0) {
          $result = true;
     }
     
     return $result;
     
}

function emailExists($email, $conn) {
     $result = false;
     $sql = "SELECT * FROM users WHERE email = '$email'";

     $result = $conn->query($sql);
     
     if ($result->num_rows > 0) {
          $result = true;
     }
     
     return $result;
     
}

function createUser($name, $pass, $email, $conn) {
     $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

     $stmt = $conn->prepare($sql);
 
     if (!$stmt) {
         die("Error preparing statement: " . $conn->error);
     }
 
     $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

     $stmt->bind_param("sss", $name, $hashedPass, $email);
 
     if ($stmt->execute()) {
          header("location: ./../signup.php?error=none");
     } else {
          header("location: ./../signup.php?error=stmtfailed");
     }
 
     $stmt->close();
     $conn->close();

     exit();
}

function loginUser($conn, $name, $pass) {
     $uidExists = uidExists($name, $conn);

     if ($uidExists === false) {
          header("location: ./../login.php?error=wronglogin");
          exit();
     }

     $sql = "SELECT password FROM users WHERE username = '$name'";
     $result = $conn->query($sql);

     if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $passHash = $row["password"];
     }

     $checkPass = password_verify($pass, $passHash);

     if ($checkPass === false) {
         header("location: ./../login.php?error=wronglogin");
         exit();
     }
     else if($checkPass === true)  {
          session_start();
          $_SESSION["userid"] = $uidExists["name"];
          header("location: ./../index.php");
          exit();
     }
}
