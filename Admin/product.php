<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../halpers/formet.php';?>

      <div class="col-sm-10 ">
      <div class="card border-dark mh-600">
          <h1 class="mb-0 alert alert-info"><strong>Products</strong></h1>
          <?php 
            $product = new product();
            if(isset($_GET['delid'])){
            $gatId = base64_decode($_GET['delid']);
            $delsuccess = $product->delete($gatId);
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
                    <th>Title</th>
                    <th>Catagory</th>
                    <th>Brand</th>
                    <th>Thumbnail</th>
                    <th>Body</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Availability</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $product  = new product;
            $Format   = new Format;
            $getItem = $product->show();
            $i = 0;
            if($getItem){
              while($result = $getItem->fetch_assoc()){
                  $i++;
            ?>
              <tr>
                <td><?=$i;?></td>
                <td><?=$Format->textShorten(ucwords($result['title']),10);?></td>
                <td><?=ucwords($result['catagoryName']);?></td>
                <td><?=ucwords($result['brandName']);?></td>
                <td><img class='' height="50" width="50" src="upload/<?=$result['thumbnail'];?>" alt=""></td>
                <td><?=$Format->textShorten(ucwords($result['body']),15);?></td>
                <td><?=$result['price'].'tk';?></td>
                <td><?=$result['discount'].'tk';?></td>
                <td><?=$result['availability'];?></td>
                <td>
                  <?php
                    if($result['type'] == 0){
                      echo 'General';
                    }else{
                      echo 'Fetured';
                    }
                  ?>
                </td>
                <td>
                  <span>
                    <a href="editeProduct.php?id=<?=base64_encode($result['id']);?>">Edite</a> ||
                    <a onclick="return confirm('Are You Sure To Delete')" href="?delid=<?=base64_encode($result['id']);?>">Delete
                  </a>
                  </span>
                </td>
              </tr>
                <?php } }?>
            </tbody>
          </table>
          </div>
          <div class="m-2">
          <a href="addProduct.php" class="btn btn-info">Add Product</a>
          </div>
        </div>
      </div>
<!-- footer -->

<?php include 'inc/footer.php';?>