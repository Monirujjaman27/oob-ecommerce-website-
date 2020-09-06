<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
    <?php
    $cat = new catagory();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catagory      = $_POST['catagory'];
        $catagorycheck = $cat->addcatagory($catagory);
    }
    ?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Add Catagory</strong></h1>
          
            <h6 class="text-warning">
            <?php if(isset($catagorycheck)){
                echo $catagorycheck;
            }?>
          </h6>
            <div class="mx-2 col-sm-4">
            <form action="" method="POST">
                <input class="form-control" name="catagory" type="text" placeholder="Catagory Name">
                <a class="btn btn-info mt-3" href="catagory.php">Back</a>
                <input class="btn btn-info mt-3 float-right" type="submit" value="Add Catagory">
            </form>
            </div>
           
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>