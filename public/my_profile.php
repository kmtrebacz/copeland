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

     </main>

     <?php
     include_once './../includes/footer.html';
     ?>

<?php include_once './../includes/bootstrap_js.html'; ?>
</body>

</html>