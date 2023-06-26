<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>CREATE LIST - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>

     <main class="container py-3">
          <div class="col-10 col-lg-3 mx-auto">
               <h3 class="text-center">NEW LIST</h3>

               <?php
               if (isset($_GET["error"])) {
                    if ($_GET["error"] == "stmtfaild"){
                         echo "<p><strong>Somethink went wrong, try again!</strong></p>";
                    }
                    else if ($_GET["error"] == "none"){
                         echo "<p><strong>New list have been created!</strong></p>";
                    }
               }
               ?>

               <form action="./php_inc/new_list.inc.php" method="POST">
                    <input type="text" name="list_name" id="list_name" required class="form-control my-2" placeholder="List name">

                    <input type="checkbox" role="switch" id="list_public" name="list_public">
                    <label for="list_public">Public</label>

                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit" name="submit">Sign in</button>
               </form>
          </div>
     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

<?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>