<?php include '../classes/adminLogin.php';?>

<?php
  $al = new adminlogin();
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $logincheck = $al->adminlogin($username, $password);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/img/favicon.ico.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/css/style.css">
      <!-- Icons/Glyphs -->
      <link rel="stylesheet" href="assets/css/font-awesome.css">

    <title>Admin Panel</title>
  </head>
  <body class='bg-light'>
  <div class="container text-lime">
      <div class="row mt-5">
          <div class="col-sm-4 m-auto">
              <div class="card px-3 pb-5 pt-4">
                  <h4 class="text-center">Admin Login</h4>
                  <span class="text-danger">
                    <?php
                      if(isset($logincheck)){
                        echo $logincheck;
                      }
                    ?>
                  </span>
                  <form action="" method="POST">
                  <br>
                      <input id="username" name="username" class="form-control" type="text" placeholder="Username">
                      <br>
                      <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                      <br>
                      <input  class="btn btn-block mt-2 btn-secondary " type="submit" value="Login">
                  </form>
                  <span class="mt-3"><a href="#">Forget Password</a></span>
              </div>
          </div>
      </div>
  </div>

    <script src="assets/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="assets/js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html> 