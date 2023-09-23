<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
     <style>
          .drag-to-scroll-items {
               scrollbar-width: thin;
               scrollbar-color: var(--secondary) var(--primary);
          }

          .drag-to-scroll-items::-webkit-scrollbar {
               width: 15px;
          }
     </style>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <section>
               <h2 class="fs-1 ms-2">MOST POPULAR ITEMS</h2>
               <div class="d-flex">
                    <?php
                    require('./php_inc/db_functions.inc.php');

                    $conn = dbConnect();

                    function convertToTitleCase($input){
                         $words = explode("_", $input);
                         $formattedWords = array_map('ucwords', $words);
                         return implode(" ", $formattedWords);
                    }

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

                    $resultItems = dbQuery($conn, "SELECT items.item_id, items.item_name, categories.category_name, items.size, items.items_view_count FROM items JOIN categories ON categories.category_id = items.category_id ORDER BY items.items_view_count DESC LIMIT 6;");

                    if ($resultItems->num_rows > 0) {
                         echo '<div class="row">';
                         while ($row = $resultItems->fetch_assoc()) {
                              if (isset($_SESSION["userid"])) {
                                   echo '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                              <div class="card">
                              <div class="card-body row">
                              <div class="col-9">
                              <form method="get" action="item.php">
                              <input type="hidden" name="item_id" value="' . $row['item_id'] . '">
                              <input type="hidden" name="item_name" value="' . $row['item_name'] . '">
                              <input type="hidden" name="category_name" value="' . convertToTitleCase($row['category_name']) . '">
                              <input type="hidden" name="size" value="' . $row['size'] . '">
                              <input type="hidden" name="view_count" value="' . $row['items_view_count'] . '">
                              <h4 class="m-0" class="card-title">
                              <input type="submit" class="m-0 p-0 border-0 bg-white" value="' . $row['item_name'] . '">
                              </h4>
                              </form>
                              <p class="my-2" style="font-size: 15px;">CATEGORY: ' . convertToTitleCase($row['category_name']) . '</p>
                              <p class="my-2" style="font-size: 15px;">SIZE: ' . $row['size'] . '</p>
                              </div>
                              <div class="col-3 d-flex align-items-center justify-content-center">
                              <div>
                              <div class="position-absolute p-3 border rounded" style="display: none; background: #fff; right: 78px; z-index: 111; width: max-content;"><form method="get" action="./php_inc/add_item_to_list.inc.php"><input type="text" name="item_id" value="' . $row['item_id'] . '" class="d-none">
                              ' . $lists . ' </form>
                              </div>
                              <div class="popover" data-on="0">
                              <button type="button" class="btn btn-primary">+</button>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>';
                              } else {
                                   echo '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                              <div class="card">
                              <div class="card-body row">
                              <div class="col-9">
                              <form method="get" action="item.php">
                              <input type="hidden" name="item_name" value="' . $row['item_name'] . '">
                              <input type="hidden" name="category_name" value="' . convertToTitleCase($row['category_name']) . '">
                              <input type="hidden" name="size" value="' . $row['size'] . '">
                              <input type="hidden" name="view_count" value="' . $row['items_view_count'] . '">
                              <h4 class="m-0" class="card-title">
                              <input type="submit" class="m-0 p-0 border-0 bg-white" value="' . $row['item_name'] . '">
                              </h4>
                              </form>
                              <p class="my-2" style="font-size: 15px;">CATEGORY: ' . convertToTitleCase($row['category_name']) . '</p>
                              <p class="my-2" style="font-size: 15px;">SIZE: ' . $row['size'] . '</p>
                              </div>
                              <div class="col-3 d-flex align-items-center justify-content-center">
                              <div>
                              <div class="position-absolute p-3 border rounded" style="display: none; background: #fff; right: 78px; z-index: 111; width: max-content;">
                              <strong>You are not logged in</strong>
                              </div>
                              <div class="popover" data-on="0">
                              <button type="button" class="btn btn-primary">+</button>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>';
                              }
                         }
                         echo '</div>';
                    } else {
                         echo "<p><strong>There are no items</strong></p>";
                    }

                    dbClose($conn);
                    ?>
               </div>
          </section>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>
     <?php include_once './../includes/bootstrap_js.html'; ?>

     <script src="./../js/popover.js"></script>
</body>

</html>