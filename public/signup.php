<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>SIGN UP - Copeland - Drum sets configurator</title>
     <link rel="stylesheet" href="./../css/main.css">
</head>

<body>

     <?php
     include_once './../includes/header/unlogged.html';
     ?>
     <main class="container py-3">
          <div class="col-10 col-lg-3 mx-auto">
               <h3 class="text-center">SIGN UP</h3>
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

     <script src="./../bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>