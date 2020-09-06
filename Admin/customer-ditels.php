<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/product.php';?>
<?php include '../classes/customer.php';?>
<?php include_once '../halpers/formet.php';?>
<?php 
    $cmr = new Customer();
    if(isset($_GET['cmrId'])){
    $gatId = base64_decode($_GET['cmrId']);
    $getResult = $cmr->checkNewOrderTbl($gatId);
    }
?>
      <div class="col-sm-8 ">
        <div class="card border-dark mh-600">
                <h1 class="mb-0 alert alert-info"><strong>Customer Details</strong></h1>
                <div class="row">
                    <div class="col-sm-6 ml-3">
                      
                        <div class="card mt-4">
                        <?php
                            if($getResult){
                                $result = $getResult->fetch_assoc();
                          
                        ?>

                            <table class="table" style='margin-bottom:0px;'>
                                
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td width="40%">Customer Name:</td>
                                    <td width="60%"><?=$result['uname'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Email:</td>
                                    <td><?=$result['email'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Country:</td>
                                    <td><?=$result['country'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>City:</td>
                                    <td><?=$result['city'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Phone:</td>
                                    <td><?=$result['phone'];?></td>
                                </tr>
                                <tr>
                                    <td>Zip Code:</td>
                                    <td><?=$result['zipCode'];?></td>
                                </tr>
                                
                            </table>


                            <?php } ?>
                        </div>
                           
                    </div>


                    
                    <div class="col-sm-4">
                        <div>
                            <img  class="card mt-4" src="upload/profile/<?=$result['image'];?>" alt="">
                        </div>
                    </div>
                    
                </div><!-- /.row -->


                <div class="row">              
                    <div class="col-sm-12">
                        <div class="m-2">
                            <a href="order.php" class="btn btn-info ml-2">OK</a>
                        </div>      
                    </div>
                </div>
            </div> <!-- card -->
        </div><!-- col -->
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>