<?php
require_once './../vendor/autoload.php';
require_once './php_inc/db_functions.inc.php';


$conn = dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
     if (isset($_SESSION["userid"])) {
          $resultLists = dbQuery($conn, "SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username='" . $_SESSION['userid'] . "';");
          $lists = '';
          if ($resultLists->num_rows > 0) {
               while ($row = $resultLists->fetch_assoc()) {
                    $lists .= '<input type="checkbox" name="item_name_' . $row['list_name'] . '" value="' . $row['list_id'] . '">  <label>' . $row['list_name'] . '</label><br>';
               }
               $lists .= '<input type="submit" class="mt-2 btn btn-primary" value="Add to list">';
          }
     }


     $loader = new \Twig\Loader\FilesystemLoader('./../templates/');
     $twig = new \Twig\Environment($loader, [
          'cache' => './../cache',
     ]);
     $template = $twig->load('item.twig');

     echo $template->render([
          'name' => $_GET['item_name'],
          'category' => $_GET['category_name'],
          'size' => $_GET['size'],
          'view_count' => $_GET['view_count'],
     ]);

     $view_count_added = (int)$_GET['view_count'] + 1;

     $sqlViewCount = 'UPDATE items SET items.items_view_count="' . $view_count_added . '" WHERE items.item_name = "' . $_GET['item_name'] . '"  AND items.size = "' . $_GET['size'] . '"';

     dbQuery($conn, $sqlViewCount);
               
     dbClose($conn);
}
?>