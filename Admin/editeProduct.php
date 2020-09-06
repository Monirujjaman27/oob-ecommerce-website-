<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/Brand.php';?>
<?php include '../classes/product.php';?>


 

<?php
    $product = new product();
    $gatId = base64_decode($_GET['id']);
    if(!isset($gatId) || $gatId == NULL){
        header('Location:product.php');
    }else{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updatePro = $product->update($_POST, $_FILES, $gatId);
    }
  }
    ?>

      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="alert alert-info mb-0"><strong>Edite Product</strong></h1>
          
            <h6 class="text-warning">
            <?php 
              if(isset($updatePro)){
                  echo $updatePro;
              }
            ?>
          </h6>
          <div class="row">
          <?php 
                $data = $product->showByGatId($gatId);
               if($data){
                 while($dataResult = $data->fetch_assoc()){   
            ?>
            <div class="mx-2 col-sm-8">
            <form action="" method="POST" enctype="multipart/form-data">
            <table>
              <tr>
                <td><label class="font-weight-bold" for="title"> Title: </label></td>
                <td>
                  <input id='title' class="form-control  my-2" name="title" type="text" value="<?php echo $dataResult['title']; if(isset($_POST['title'])){echo $_POST['title'];} ?>">
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
                    <?php
                      if($dataResult['catId'] == $result['id']) {?>
                        selected = 'selected';
                       <?php } ?>
                       <?php if(isset($_POST['catId']) AND $_POST['catId'] == $result['id']){?> 
                        selected = 'selected';
                       <?php } ?>
                       value="<?=$result['id'];?>" ><?=ucwords($result['catagoryName']);?>
                     </option>
                          <?php } }?>
                  </select>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="brandId"> Brand: </label></td>
                <td>
                  <select class="form-control" name="brandId" id="brandId">
                    <option value="">Select</option>
                    <?php
                     $brand = new brand();
                     $getresult = $brand->show();
                     if($getresult){
                       while($result = $getresult->fetch_assoc()){
                    ?>
                    <option 
                     <?php 
                      if($dataResult['brandId'] == $result['id']) {?>
                        selected = 'selected';
                       <?php } ?>
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
                  <textarea  class="form-control my-2" name="body" id="body" cols="30" rows="2" placeholder="Body">
                  <?php echo $dataResult['body'];if(isset($_POST['body'])){echo $_POST['body'];};?></textarea>
                </td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="price">Price: </label></td>
                <td>
                  <input class="form-control my-2" id='price' name="price" type="number" value="<?php echo $dataResult['price']; if(isset($_POST['price'])){echo $_POST['price'];} ?>"></td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="discount">Discount: </label></td>
                <td>
                  <input class="form-control my-2" id='discount' name="discount" type="number" value="<?php echo $dataResult['discount']; if(isset($_POST['discount'])){echo $_POST['discount'];} ?>"></td>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="type">Type: </label></td>
                <td>
                  <select class="form-control" name="type" id="type">
                      <option value="">Select</option>
                      <option 
                      <?php 
                      if($dataResult['type'] == ($dataResult['type'] == 0)) {?>
                        selected = 'selected';
                       <?php } ?>
                      <?php if(isset($_POST['type']) AND $_POST['type'] == 0) { ?> 
                        selected = 'selected'
                       <?php } ?>
                       value="0">General</option>

                      <option 
                      <?php 
                      if($dataResult['type'] == ($dataResult['type'] == 1)) {?>
                        selected = 'selected';
                       <?php } ?>
                      <?php if(isset($_POST['type']) AND $_POST['type'] == 1){?> 
                        selected = 'selected';
                       <?php } ?>
                      value="1">Fetured</option>
                  </select>
              </tr>
              <tr>
                <td><label class="font-weight-bold" for="type">Availability: </label></td>
                <td>
                  <select class="form-control" name="availability" id="availability">
                      <option value="">Select</option>
                      <option 
                      <?php 
                      if($dataResult['availability'] == ($dataResult['availability'] == 'In Stock')) {?>
                        selected = 'selected';
                       <?php } ?>
                      <?php if(isset($_POST['availability']) AND $_POST['availability'] == 'In Stock') { ?> 
                        selected = 'selected'
                       <?php } ?>
                       value="In Stock">In Stock</option>

                      <option 
                      <?php 
                      if($dataResult['availability'] == ($dataResult['availability'] == 'Out Of Stock')) {?>
                        selected = 'selected';
                       <?php } ?>
                      <?php if(isset($_POST['availability']) AND $_POST['availability'] == 'Out Of Stock'){?> 
                        selected = 'selected';
                       <?php } ?>
                      value="Out Of Stock">Out Of Stock</option>
                  </select>
              </tr>
              <tr>
                <td>
                  <a class="btn btn-info mt-3" href="product.php">Back</a>
                </td>
                <td>
                  <input class="btn btn-info mt-3 float-right" type="submit" value="Update Product ">
                </td>
              </tr>
            </table>
            </form>
                      
            </div>
            <div class="mx-2 col-sm-2">
                    <div class="card"><img height="150" width="150" src="upload/<?=$dataResult['thumbnail']?>" alt=""></div>    
            </div>
            <?php } } ?>
            </div>
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>