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
     include_once './../includes/header/unlogged.html';
     ?>
     <main class="container py-3">

          <form action="login.php" method="POST">
               <div class="col-10 col-lg-3 mx-auto">
                    <h3 class="text-center">LOGIN</h3>
                    <div class="form-floating my-2">
                         <input type="text" id="username" name="username" required class="form-control" placeholder="Username">
                         <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating my-2">
                         <input type="password" id="password" name="password" required class="form-control" placeholder="Password">
                         <label for="password">Password</label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary my-2" type="submit">Sign in</button>
               </div>
          </form>

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

     <?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>