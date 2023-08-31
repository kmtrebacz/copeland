<?php
session_start();
require_once './../../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
     foreach ($_GET as $paramName => $paramValue) {
          if (strpos($paramName, 'item_name_') === 0) {
               $item = substr($paramName, strlen('item_name_'));

               echo "SELECTED: $item (ID: $paramValue)<br>";
          }
     }
}
