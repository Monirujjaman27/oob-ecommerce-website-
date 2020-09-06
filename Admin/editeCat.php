<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
    <?php
    $cat = new catagory();
    $gatCatId = base64_decode($_GET['id']);
    if(!isset($gatCatId) ||  $gatCatId == NULL){
        header('Location:catagory.php');
    }else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $editecat = $_POST['editecat'];
            $catagorycheck = $cat->updatecatagory($editecat,$gatCatId);
        }
    }
    
    
     $sowcat = new catagory();
              $getcat = $sowcat->showvalcalt($gatCatId);
              $showresult = $getcat->fetch_assoc();
    ?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Update Catagory</strong></h1>
          
            <h6 class="text-warning">
            <?php if(isset($catagorycheck)){
                echo $catagorycheck;
            }?>
          </h6>
            <div class="mx-2 col-sm-4">
            <form action="" method="POST">
                <input class="form-control" name="editecat" type="text" value="<?=$showresult['catagoryName'];?>">
                <a class="btn btn-info mt-3" href="catagory.php">Back</a>
                <input class="btn btn-info mt-3 float-right" type="submit" value="Update Catagory">
            </form>
            </div>
           
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>