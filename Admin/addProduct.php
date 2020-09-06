<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/product.php';?>


    <?php
    $product = new product();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $insert = $product->insert($_POST, $_FILES);
    }
    ?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Add Product</strong></h1>
          
            <h6 class="text-warning">
            <?php 
              if(isset($insert)){
                  echo $insert;
              }
            ?>
          </h6>
            <div class="mx-2 col-sm-8">
            <form action="" method="POST" enctype="multipart/form-data">
            <table>
              <tr>
                <td><label class="font-weight-bold" for="title"> Title: </label></td>
                <td>
                  <input id='title' class="form-control  my-2" name="title" type="text" placeholder="Product Tilte" value="<?php if(isset($_POST['title'])){echo $_POST['title'];}?>">
                  </td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="catId"> Catagory: </label></td>
                <td>
                  <select class="form-control my-2" name="catId" id="catId">
                    <option value="">Select</option>
                      <?php
                        $sowcat = new catagory();
                        $getcat = $sowcat->showCatagory();
                        if($getcat){
                          while($result = $getcat->fetch_assoc()){
                      ?>
                      
                    <option 
                       <?php if(isset($_POST['catId']) AND $_POST['catId'] == $result['id']){?> 
                        selected = 'selected';
                       <?php } ?>
                       value="<?=$result['id'];?>"><?=ucwords($result['catagoryName']);?>
                     </option>
                          <?php } }?>
                  </select>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="brandId"> Brand: </label></td>
                <td>
                  <select class="form-control" name="brandId" id="brandId" value="<?php if(isset($_POST['brandId'])){echo $_POST['brandId'];};?>">
                    <option value="">Select</option>
                    <?php
                     $brand = new brand();
                     $getresult = $brand->show();
                     if($getresult){
                       while($result = $getresult->fetch_assoc()){
                    ?>
                    <option 
                     <?php 
                      if(isset($_POST['brandId']) AND $_POST['brandId'] == $result['id']){?> 
                        selected = 'selected';
                       <?php } ?>
                       value="<?=$result['id'];?>"><?=ucwords($result['brandName']);?>
                      </option>
                        <?php } } ?>
                  </Select>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="thumbnail">Thumbnail: </label></td>
                <td>
                  <input class="my-2" id='thumbnail' name="thumbnail" type="file" placeholder="Product Tilte" ></td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="body">Body: </label></td>
                <td>
                  <textarea  class="form-control  my-2" name="body" id="body" cols="30" rows="2" placeholder="Body"><?php if(isset($_POST['body'])){echo $_POST['body'];};?></textarea>
                </td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="price">Price: </label></td>
                <td>
                  <input class="form-control my-2" id='price' name="price" type="number" placeholder="Price" value="<?php if(isset($_POST['price'])){echo $_POST['price'];};?>"></td>
              </tr>
              <tr>
              <tr>
                <td><label class="font-weight-bold" for="Discount">Discount: </label></td>
                <td>
                  <input class="form-control my-2" id='Discount' name="discount" type="number" placeholder="Discount" value="<?php if(isset($_POST['discount'])){echo $_POST['discount'];};?>"></td>
              </tr>
              <tr class="my-5">
                <td><label class="font-weight-bold" for="type">Type: </label></td>
                <td>
                  <select class="form-control" name="type" id="type">
                      <option value="">Select</option>
                      <option 
                      <?php if(isset($_POST['type']) AND $_POST['type'] == 0) { ?> 
                        selected = 'selected'
                       <?php } ?>
                       value="0">General</option>
                      <option 
                      <?php if(isset($_POST['type']) AND $_POST['type'] == 1){?> 
                        selected = 'selected';
                       <?php } ?>
                      value="1">Fetured</option>
                  </select>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="availability">Availability: </label></td>
                <td>
                  <select class="form-control" name="availability" id="availability">
                      <option value="">Select</option>
                      <option 
                      <?php if(isset($_POST['availability']) AND $_POST['availability'] == 'In Stock') { ?> 
                        selected = 'In Stock'
                       <?php } ?>
                       value="In Stock">In Stock</option>
                      <option 
                      <?php if(isset($_POST['availability']) AND $_POST['availability'] == 'Out Of Stock'){?> 
                        selected = 'Out Of Stock';
                       <?php } ?>
                      value="Out Of Stock">Out Of Stock</option>
                  </select>
              </tr>
              <tr>
                <td>
                  <a class="btn btn-info mt-3" href="product.php">Back</a>
                </td>
                <td>
                  <input class="btn btn-info mt-3 float-right" type="submit" value="Add New Product ">
                </td>
              </tr>
            </table>
            </form>
            </div>
           
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>