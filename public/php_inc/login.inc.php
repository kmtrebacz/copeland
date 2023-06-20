<?php

if (isset($_POST["submit"])) {

     $name = $_POST["name"];
     $pass = $_POST["password"];

     echo $name;

     require_once './../../includes/db_connection.php';
     require_once './functions.inc.php';

     loginUser($conn, $name, $pass);

}
else {
     header("location: ./../login.php");
     exit();
}
