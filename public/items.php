<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>ITEMS - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <?php
          require('./../includes/db_connection.php');

          function convertToTitleCase($input) {
               $words = explode("_", $input);
               $formattedWords = array_map('ucwords', $words);
               return implode(" ", $formattedWords);
          }

          $query = "SELECT items.item_name, categories.category_name, items.size FROM items JOIN categories ON categories.category_id = items.category_id WHERE 1;";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
               echo '<div class="row">';
               while ($row = $result->fetch_assoc()) {
                    echo '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                    <div class="card">
                    <div class="card-body row">
                    <div class="col-9">
                    <form method="post" action="item.php">
                    <input type="hidden" name="item_name" value="' . $row['item_name'] . '">
                    <input type="hidden" name="category_name" value="' . convertToTitleCase($row['category_name']) . '">
                    <input type="hidden" name="size" value="' . $row['size'] . '">
                    <h4 class="m-0" class="card-title">
                    <input type="submit" class="m-0 p-0 border-0 bg-white" value="' . $row['item_name'] . '">
                    </h4>
                    </form>
                    <p class="my-2" style="font-size: 15px;">CATEGORY: ' . convertToTitleCase($row['category_name']) . '</p>
                    <p class="my-2" style="font-size: 15px;">SIZE: ' . $row['size'] . '</p>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center">
                    <button type="button" class="btn btn-primary">+</button>
                    </div>
                    </div>
                    </div>
                    </div>';
               }
               echo '</div>';
          } else {
               echo "<p><strong>There are no items</strong></p>";
          }

          $conn->close();
          ?>

     </main>


     <?php
     include_once './../includes/footer.html';
     ?>

     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>