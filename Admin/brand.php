<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/Brand.php';?>


      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="mb-0 alert alert-info"><strong>All Brands</strong></h1>
          <?php 
            $brand = new brand();
            if(isset($_GET['delid'])){
            $gatId = base64_decode($_GET['delid']);
            $delsuccess = $brand->delBrand($gatId);
            }
            if(isset($delsuccess)){
                  echo $delsuccess;
              }
          ?>
          <div class="d-flex">
          <table class="m-2 table table-hover table-bordered table-striped w-98">
            <thead class='w-100'>
                <tr class='w-100'>
                    <th>No</th>
                    <th>Catagory Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $getItem = $brand->show();
              $i = 0;
              if($getItem){
                while($result = $getItem->fetch_assoc()){
                  $i++;
            ?>
              <tr>
                <td><?=$i?></td>
                <td><?=ucwords($result['brandName']);?></td>
                <td>
                  <span>
                    <a href="editeBrand.php?id=<?=base64_encode($result['id']);?>">Edite</a> ||
                    <a onclick="return confirm('Are You Sure To Delete')" href="?delid=<?=base64_encode($result['id']);?>">Delete</a>
                  </span>
                </td>
              </tr>
                <?php } }?>
            </tbody>
          </table>
          </div>
          <div class="m-2">
          <a href="addBrand.php" class="btn btn-info">Add Brand</a>
          </div>
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>