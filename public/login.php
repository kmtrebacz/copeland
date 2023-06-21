<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>LOGIN - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>
     <main class="container py-3">


          <div class="col-10 col-lg-3 mx-auto">
               <h3 class="text-center">LOGIN</h3>

               <?php
               if (isset($_GET["error"])) {
                    if ($_GET["error"] == "wronglogin") {
                         echo "<p><strong>Incorrect login information!</strong></p>";
                    }
               }
               ?>

               <form action="./php_inc/login.inc.php" method="POST">
                    <input type="text" id="name" name="name" required class="form-control my-2" placeholder="Username">
                    
                    <input type="password" id="password" name="password" required class="form-control my-2" placeholder="Password">

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