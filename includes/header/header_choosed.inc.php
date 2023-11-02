<?php
if (isset($_SESSION["userId"])) {
    include_once "./../includes/header/logged.html";
} else {
    include_once "./../includes/header/unlogged.html";
}
?>