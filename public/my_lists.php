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
          require('./../includes/db_connection.php');
          $user_id = $_SESSION['userid'];

          $sql = "SELECT user_id FROM users WHERE username = '$user_id'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               $user_id = $row["user_id"];
          }

          $query = "SELECT list_name, is_public FROM lists WHERE list_id = " . $user_id;
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
               echo '<div class="row">';

               while ($row = $result->fetch_assoc()) {
                    echo
                    '<div class="card col-10 col-lg-4">
                    <div class="card-body">
                    <h5 class="card-title">' . $row['list_name'] . '</h5>
                    <a class="link-offset-1 mt-1" href="#">See more</a>
                    </div>
                    </div>';
               }
               echo '</div>';
          } else {
               echo "<p><strong>You don't have any lists</strong></p>";
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