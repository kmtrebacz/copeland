<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ITEM - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <?php

          require('./../includes/db_connection.php');
          if ($_SERVER["REQUEST_METHOD"] == "GET") {
               if (isset($_SESSION["userid"])) {

                    $queryLists = "SELECT lists.list_id, lists.list_name FROM lists JOIN users ON users.user_id = lists.user_id WHERE users.username='" . $_SESSION['userid'] . "';";
                    $resultLists = $conn->query($queryLists);
                    $lists = '';
                    if ($resultLists->num_rows > 0) {
                         while ($row = $resultLists->fetch_assoc()) {
                              $lists .= '<input type="checkbox" name="item_name_' . $row['list_name'] . '" value="' . $row['list_id'] . '">  <label>' . $row['list_name'] . '</label><br>';
                         }
                         $lists .= '<input type="submit" class="mt-2 btn btn-primary" value="Add to list">';
                    }

                    echo '<section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">' . $_GET['item_name'] . '</h1>
                    <h3>' . $_GET['category_name'] . '</h3>
                    <p>Size: ' . $_GET['size'] . '</p>
                    <div class="d-flex">
                    <div>
                    <div class="position-absolute p-3 border rounded" style="display: none; background: #fff; margin-top: 46px; z-index: 111;">
                    <form method="get" action="./php_inc/add_item_to_list.inc.php"><input type="text" name="item_id" value="' . $_GET['item_id'] . '" class="d-none">
                    ' . $lists . ' </form>                   
                    </div>
                    <div class="popover" data-on="0">
                    <button type="button" class="btn btn-primary">+ Add to list</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </section>';
               } else {
                    echo '<section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">' . $_GET['item_name'] . '</h1>
                    <h3>' . $_GET['category_name'] . '</h3>
                    <p>Size: ' . $_GET['size'] . '</p>
                    <div class="d-flex">
                    <div>
                    <div class="position-absolute p-3 border rounded" style="display: none; background: #fff; margin-top: 46px; z-index: 111;">
                    <strong>You are not logged in</strong>
                    </div>
                    <div class="popover" data-on="0">
                    <button type="button" class="btn btn-primary">+ Add to list</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </section>';
               }

               require('./../includes/db_connection.php');

               $view_count_added = (int)$_GET['view_count'] + 1;

               $sql = 'UPDATE items SET items.items_view_count="' . $view_count_added . '" WHERE items.item_name = "' . $_GET['item_name'] . '"  AND items.size = "' . $_GET['size'] . '"';

               $stmt = $conn->prepare($sql);

               $stmt->execute();

               $stmt->close();
               $conn->close();
          }
          ?>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

     <script src="./../js/popover.js"></script>
     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>