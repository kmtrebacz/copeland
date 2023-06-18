<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>REGISTER - Copeland - Drum sets configurator</title>
     <link rel="stylesheet" href="./../css/main.css">
</head>

<body>

     <?php
     require './../includes/header/unlogged.html';
     ?>
     <main class="container py-3">
          <form action="register.php" method="POST">
               <div class="col-10 col-lg-3 mx-auto">
                    <h3 class="text-center">REGISTER</h3>
                    <div class="form-floating my-2">
                         <input type="text" id="username" name="username" required class="form-control" placeholder="Username">
                         <label for="username">Username</label>
                    </div>
                    <div class="form-floating my-2">
                         <input type="email" id="email" name="email" required class="form-control" placeholder="Email">
                         <label for="email">Email</label>
                    </div>
                    <div class="d-flex">
                         <div class="form-floating col-6 my-2 pe-1">
                              <input type="password" id="password" name="password" required class="form-control" placeholder="Password">
                              <label for="password">Password</label>
                         </div>
                         <div class="form-floating col-6 my-2 ps-1">
                              <input type="password" id="r_password" name="r_password" required class="form-control" placeholder="Repeat password">
                              <label for="r_password">Repeat password</label>
                         </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Sign in</button>
               </div>
          </form>
     </main>

     <?php
     require './../includes/footer.html';
     ?>

     <script src="./../bootstrap/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>