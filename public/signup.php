<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>SIGN UP - Copeland - Drum sets configurator</title>
     <?php include_once './../includes/bootstrap_css.html'; ?>
</head>

<body>

     <?php
     include_once './../includes/header/header_choosed.inc.php';
     ?>
     
     <main class="container py-3">
          <div class="col-10 col-lg-3 mx-auto">
               <h3 class="text-center">SIGN UP</h3>

               <?php
               if (isset($_GET["error"])) {
                    if ($_GET["error"] == "invaliduid"){
                         echo "<p><strong>Choose a proper username!</strong></p>";
                    }
                    else if ($_GET["error"] == "invalidemail"){
                         echo "<p><strong>Choose a proper email!</strong></p>";
                    }
                    else if ($_GET["error"] == "passwordsdontmatch"){
                         echo "<p><strong>Passwords doesn't match!</strong></p>";
                    }
                    else if ($_GET["error"] == "usernametaken"){
                         echo "<p><strong>This username is already associated with an existing account!</strong></p>";
                    } 
                    else if ($_GET["error"] == "emailwasused"){
                         echo "<p><strong>This email address is already associated with an existing account!</strong></p>";
                    }
                    else if ($_GET["error"] == "stmtfaild"){
                         echo "<p><strong>Somethink went wrong, try again!</strong></p>";
                    }
                    else if ($_GET["error"] == "none"){
                         echo "<p><strong>You have signed up!</strong></p>";
                    }
               }
               ?>

               <form action="./php_inc/singup.inc.php" method="POST">
                    <input type="text" name="name" id="name" required class="form-control my-2" placeholder="Username">
                    
                    <input type="email" name="email" id="email" required class="form-control my-2" placeholder="Email">

                    <input type="password" name="pwd" id="pwd" required class="form-control my-2" placeholder="Password">

                    <input type="password" name="r_pwd" id="r_pwd" required class="form-control my-2" placeholder="Repeat password">

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