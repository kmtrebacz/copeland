<?php
session_start();

if (!isset($_SESSION["userid"])) {
     header("location: ./../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>MY LISTS - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <?php
          require('./php_inc/db_functions.inc.php');

          $conn = dbConnect();
          $userId = $_SESSION['userid'];

          $resultName = dbOutput($conn, 'SELECT user_id FROM users WHERE username = "'. $userId . '";');

          if ($resultName->num_rows > 0) {
               $row = $resultName->fetch_assoc();
               $userId = $row["user_id"];
          }

          $resultItems = dbOutput($conn, 'SELECT list_name, is_public FROM lists WHERE user_id = "' . $userId . '";');

          if ($resultItems->num_rows > 0) {
               echo '<div class="row">';

               while ($row = $resultItems->fetch_assoc()) {
                    if ($row['is_public'] == 0) {
                         echo
                         '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                         <div class="card">
                         <div class="card-body">
                         <h4 class="m-0" class="card-title">' . $row['list_name'] . '</h4>
                         <p class="my-2" style="font-size: 15px;"><i class="bi bi-lock"></i> Private</p>
                         <form method="get" action="list.php">
                         <input type="hidden" name="list_name" value="' . $row['list_name'] . '">
                         <input type="hidden" name="is_public" value="' . $row['is_public'] . '">
                         <a class="link-offset-1 mt-1" class="card-title">
                         <input type="submit" class="m-0 p-0 border-0 text-primary bg-white text-decoration-underline" value="See more">
                         </a>
                         </form>
                         </div>
                         </div>
                         </div>';
                    }
                    else if ($row['is_public'] == 1)  {
                         echo
                         '<div class="px-2 col-10 col-lg-4 mx-auto mx-lg-0 my-2">
                         <div class="card">
                         <div class="card-body">
                         <h4 class="m-0" class="card-title">' . $row['list_name'] . '</h4>
                         <p class="my-2" style="font-size: 15px;"><i class="bi bi-globe2"></i> Public</p>
                         <form method="get" action="list.php">
                         <input type="hidden" name="list_name" value="' . $row['list_name'] . '">
                         <input type="hidden" name="is_public" value="' . $row['is_public'] . '">
                         <a class="link-offset-1 mt-1" class="card-title">
                         <input type="submit" class="m-0 p-0 border-0 text-primary bg-white text-decoration-underline" value="See more">
                         </a>
                         </form>
                         </div>
                         </div>
                         </div>';
                    }
               }
               echo '</div>';
          } else {
               echo "<p><strong>You don't have any lists</strong></p>";
          }

          dbClose($conn);
          ?>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>
