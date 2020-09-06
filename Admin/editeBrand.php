<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/Brand.php';?>
    <?php
    $brand = new brand();
    $gatId = base64_decode($_GET['id']);
    if(!isset($gatId) ||  $gatId == NULL){
        header('Location:catagory.php');
    }else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $edit = $_POST['edite'];
            $check = $brand->updatebrand($edit,$gatId);
        }
    }
        $get = $brand->showvalBrand($gatId);
        $result = $get->fetch_assoc();
    ?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Update Brand</strong></h1>
          
            <h6 class="text-warning">
            <?php if(isset($check)){
                echo $check;
            }?>
          </h6>
            <div class="mx-2 col-sm-4">
            <form action="" method="POST">
                <input class="form-control" name="edite" type="text" value="<?=$result['brandName'];?>">
                <a class="btn btn-info mt-3" href="brand.php">Back</a>
                <input class="btn btn-info mt-3 float-right" type="submit" value="Update">
            </form>
            </div>
           
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>