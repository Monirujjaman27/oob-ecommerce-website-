<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/customer.php';?>
<?php include_once '../halpers/formet.php';?>

      <div class="col-sm-8 ">
        <div class="card border-dark mh-600">
            <h1 class="mb-0 alert alert-info"><strong>Customer Order</strong></h1>
            <h4 class="ml-2">New Order</h4>
            

            <?php 
            $cmr = new Customer();
              if(isset($_GET['NA'])){
              $gatId = base64_decode($_GET['NA']);
              $updateStatus = $cmr->updateNA($gatId);
              }
            ?>
            <?php 
            $cmr = new Customer();
              if(isset($_GET['id'])){
              $gatId = base64_decode($_GET['id']);
              $updateStatus = $cmr->updateStatus($gatId);
              }
            ?>
            <div class="d-flex">
              <table class="m-2 table table-hover table-bordered table-striped w-98">
                <thead class='w-100'>
                    <tr class='w-100'>
                        <th>No</th>
                        <th>ProId</th>
                        <th>Time</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Qtty</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $cmr = new Customer();
                $Format   = new Format;
                $orderdtls = $cmr->checkorderTbl();
                if($orderdtls){
                    $i = 0;
                    while($detsilsResult = $orderdtls->fetch_assoc()){
                        $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$detsilsResult['productId'];?></td>
                    <td><?=$detsilsResult['dateTime'];?></td>
                    <td><?=$Format->textShorten(ucwords($detsilsResult['ProductName']),10);?></td>
                    
                    <td><img class='' height="25" width="25" src="upload/<?=$detsilsResult['image'];?>" alt=""></td>
                    
                    <td>$<?=$detsilsResult['price'];?></td>
                    <td><?=$detsilsResult['quantity'];?></td>
                    <td><a href="customer-ditels.php?cmrId=<?=base64_encode($detsilsResult['id']);?>">View</a></td>
                    
                    <td>
                      <span>
                     


                        <?php
                          if($detsilsResult['NA'] == 0){?>
                                    <a class="float-right" onclick="return confirm('Are You Sure This Product is not avaliable Right Now!')" href="?NA=<?=base64_encode($detsilsResult['id']);?>">N/A</a>
                                    <?php
                                  if($detsilsResult['status'] == 0){?>
                                    <a href="?id=<?=base64_encode($detsilsResult['id']);?>">Ok</a> 

                                  <?php }else{?>
                                  <i class="fa fa-check"></i>
                                  <?php }?> ||
                          <?php }elseif($detsilsResult['NA'] == 1){?>
                                  <p class="float-right" onclick="return confirm('Are You Sure This Product is not avaliable Right Now!')" href="?NA=<?=base64_encode($detsilsResult['id']);?>">N/A</p>
                                <?php } else{
                                    echo ' <i class="fa fa-check"></i>';
                          }?>
                       
                      </span>
                    </td>
                  </tr>
                    <?php } }?>
                </tbody>
              </table>
            </div>
           
          </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>