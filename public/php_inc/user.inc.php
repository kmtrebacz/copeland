<?php

class User {
    public function __construct() {
        require_once './../../includes/db_connection.php';
    }

    // LOGIN
    protected function uidExists($name, $conn) {
        $sql     =  "SELECT * FROM users WHERE username = '$name'";
        $result  =  $conn->query($sql);
        
        $result -> num_rows > 0 ? $result = true : $result = false;
        
        return $result;
    }

    public function login($conn, $name, $pwd) {
        $uidExists = uidExists($name, $conn);

        if (!$uidExists) {
            header("location: ./../login.php?error=wronglogin");
            exit();
        }

        $sql     =  "SELECT password FROM users WHERE username = '$name'";
        $result  =  $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pwdHash = $row["password"];
        }
   
        $checkPass  =  password_verify($pwd, $pwdHash);

        if ($checkPass === false) {
            header("location: ./../login.php?error=wronglogin");
            exit();
        }
        else if($checkPass === true)  {
            session_start();
            $_SESSION['userid'] = $name;
            header("location: ./../index.php");
            exit();
        }
    }

    // REGISTER
    private function invalidUid($name) {
        $result = true;
        if (preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            $result = false;
        }
        if ($name = 'admin') {
            $result = false;
        }
        return $result;
    }
    
    private function passMatch($pwd, $rPwd) {
        $pwd != $rPwd ? $result = true : $result = false;
        return $result;
    }
    
    private function uidExists($name, $conn) {
        $sql = "SELECT * FROM users WHERE username = '$name'";
    
        $result = $conn->query($sql);
            
        $result->num_rows > 0 ? $result = true : $result = false;
    
        return $result;
    }
    
    private function emailExists($email, $conn) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
    
        $result = $conn->query($sql);
            
        $result->num_rows > 0 ? $result = true : $result = false;
            
        return $result;   
    }
    
    private function checkInfo($name, $pwd, $rPwd, $email, $conn) {
        invalidUid($name) || passMatch($pwd, $rPwd) || uidExists($name, $conn) || emailExists($email, $conn) ? return false : return true;
    }
   
   public function register($name, $pwd, $rPwd, $email, $conn) {
        if (checkInfo($name, $pwd, $rPwd, $email, $conn)) {
            $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    
            $stmt = $conn->prepare($sql);
        
            if (!$stmt) {
                die("Error preparing statement: " . $conn->error);
            }
        
            $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);
    
            $stmt->bind_param("sss", $name, $pwdHass, $email);
        
            if ($stmt->execute()) {
                header("location: ./../signup.php?error=none");
            } else {
                header("location: ./../signup.php?error=stmtfailed");
            }
        
            $stmt->close();
            $conn->close();
        }
   
        exit();
   }
}