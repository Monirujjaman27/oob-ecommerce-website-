<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/brand.php';?>
    <?php
    $brand = new brand();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName      = $_POST['brandName'];
        $brandNamecheck = $brand->addbrand($brandName);
    }
    ?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Add Brand</strong></h1>
          
            <h6 class="text-warning">
            <?php if(isset($brandNamecheck)){
                echo $brandNamecheck;
            }?>
          </h6>
            <div class="mx-2 col-sm-4">
            <form action="" method="POST">
                <input class="form-control" name="brandName" type="text" placeholder="Brand Name">
                <a class="btn btn-info mt-3" href="brand.php">Back</a>
                <input class="btn btn-info mt-3 float-right" type="submit" value="Add Brand">
            </form>
            </div>
           
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>