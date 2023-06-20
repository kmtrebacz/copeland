<?php
session_start();

if (isset($_SESSION["userid"])) {
     include_once './includes/header/logged.html';
}
else {
     include_once './includes/header/unlogged.html';
}