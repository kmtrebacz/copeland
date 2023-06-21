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
     <title>MY PROFILE - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <?php
          $name = $_SESSION["userid"];
          $sql = "SELECT * FROM users WHERE username = '$name'";

          require_once './../includes/db_connection.php';

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
               $row = $result->fetch_assoc();
               echo '<div class="col-4"><table class="table table-striped"><tbody><tr>';
               echo '<th scope="row">Username</th><td>' . $row["username"] . '</td></tr>';
               echo '<tr><th scope="row">Email</th><td>' . $row["email"] . '</td></tr>';
               echo '</tbody></table></div>';
          } else {
               echo "No results found.";
          }
          ?>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>