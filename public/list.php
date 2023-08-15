<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>LIST - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">

          <?php
          if ($_SERVER["REQUEST_METHOD"] == "GET") {
               if ($_GET['is_public'] == "0") {
                   echo '<section class="py-5">
                   <div class="container px-4 px-lg-5 my-5">
                   <div class="row gx-4 gx-lg-5 align-items-center">
                   <div class="col-md-12">
                   <h1 class="display-5 fw-bolder">' . $_GET['list_name'] . '</h1>
                   <h4 class="my-2"><i class="bi bi-lock"></i> Private</h4>
                   <div class="d-flex">
                   </div>
                   </div>
                   </div>
                   </div>
                   </section>';
               } else {
                   echo '<section class="py-5">
                   <div class="container px-4 px-lg-5 my-5">
                   <div class="row gx-4 gx-lg-5 align-items-center">
                   <div class="col-md-12">
                   <h1 class="display-5 fw-bolder">' . $_GET['list_name'] . '</h1>
                   <h4 class="my-2"><i class="bi bi-globe2"></i> Public</h4>
                   <div class="d-flex">
                   </div>
                   </div>
                   </div>
                   </div>
                   </section>';
               }
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
