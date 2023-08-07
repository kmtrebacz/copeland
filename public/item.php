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
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
               echo '<section class="py-5">
               <div class="container px-4 px-lg-5 my-5">
               <div class="row gx-4 gx-lg-5 align-items-center">
               <div class="col-md-6"></div>
               <div class="col-md-6">
               <h1 class="display-5 fw-bolder">' . $_POST['item_name'] . '</h1>
               <h3>' . $_POST['category_name'] . '</h3>
               <p>Size: ' . $_POST['size'] . '</p>
               <div class="d-flex">
               <button class="btn btn-primary flex-shrink-0" type="button">
               <i class="bi bi-plus-lg me-1"></i>
               Add to list
               </button>
               </div>
               </div>
               </div>
               </div>
          </section>';
          }
          ?>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>