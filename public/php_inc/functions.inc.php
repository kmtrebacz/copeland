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

function uidExists($name, $email, $conn) {
     $result = false;
     $sql = "SELECT * FROM users WHERE username = '$name' OR email = '$email'";

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
 
     $stmt->bind_param("sss", $name, $pass, $email);
 
     if ($stmt->execute()) {
         echo "User created successfully!";
     } else {
         echo "Error creating user: " . $stmt->error;
     }
 
     $stmt->close();
     $conn->close();

     header("location: ./../signup.php?error=none");
     exit();
}