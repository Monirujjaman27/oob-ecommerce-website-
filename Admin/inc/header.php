<?php
 include '../lib/session.php';
 Session::checkSession();
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
      <link rel="stylesheet" href="../assets/css/font-awesome.css">

    <title>Admin Panel</title>
  </head>
  <body class="dashboard-body">
    <header>
        <nav class="m-0">
            <div class="row mx-3">
              <div class="col-sm-8">
                <h1 class="float-left">Dashboard</h1>
              </div>
              <div class="col-sm-4">
                <ul class="header-top-menue d-flex float-right mt-2">
                <?php
                  if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                    session::destroy();
                  }
                ?>
                  <li class="mr-2"><a href="#">Name: <?php echo session::get('name'); echo' |' ;?></a></li>
                  <li class="mr-2"><a href="?action=logout">Logout</a></li>
                </ul>
              </div>
            </div>            
        </nav>
    </header>