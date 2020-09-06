<?php include "inc/header.php";?>
<?php
  $login =   Session::get("cmrLogin");
  if($login == false){
    echo "<script>window.location='login.php';</script>";

  }
    
?>
<?php
    if(isset($_GET["actionOrder"]) && $_GET["actionOrder"] == "order"){
        $cmrId = Session::get('cmrId');
        $comOrder = $cmr->insertOrderInfo($cmrId);
        $cart->delCrtData();
        echo "<script>window.location='order.php';</script>";
    }
?>



<style>
.body-content{font-size:15px;}
.card {padding:6px;}
  .card table tr td{padding:10px;}
  .width-50{width:50%;}
  .mb-2{margin-bottom:15px;}
  .f-right{float:right;}
  .cntu-shop{font-size:18px;}
  .width-60{width:60%;}
</style>
<div class="body-content outer-top-bd">
	<div class="container">
		<div class="x-page inner-bottom-sm">
			<div class="row">
                <div class="col-md-6 col-sm-12 card">
                    <h2 class="text-center mb-2">Product Details</h2>
                    <div class="card">
                        <div class="shopping-cart-table ">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-sm">
                                <thead>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total price</th>
                                </thead>
                                    <!-- /thead -->
                                    <tbody>
                                        <?php 
                                            $crt = new cls_cart();
                                            $data = $crt->selectCrtProduct();
                                            $i=0;
                                            $sum = 0;
                                            $qtt = 0;

                                            if($data){
                                                while($addToCartResult = $data->fetch_assoc()){
                                                    $i++;
                                        ?>
                                        <tr>
                                            <td><?=$i;?></td>

                                            <td><?=$addToCartResult['productName'];?></td>
                                        
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="details.php?id=<?=base64_encode($addToCartResult['productId']);?>">
                                                        <img height="25" width="25" src="Admin/upload/<?=$addToCartResult['image'];?>" alt="">
                                                    </a>

                                            <td><?=$addToCartResult['price'];?></td>
                                            


                                            <td class="cart-product-quantity"><?=$addToCartResult['quantity'];?></td>


                                            <td class="cart-product-grand-total">
                                                <span class="cart-grand-total-price">$
                                                    <?php
                                                    $total = $addToCartResult['quantity']*$addToCartResult['price'];
                                                    echo $total;
                                                    ?>
                                                </span>
                                            </td>
                                            
                                        </tr>
                                        <?php 
                                            $sum = $sum + $total;
                                            $qtt = $qtt + $addToCartResult['quantity'];
                                            session::set('qtt', $qtt);

                                            } }else{
                                                echo "<script>window.location='index.php';</script>";
                                            }
                                        ?>
                                    </tbody>
                                    <!-- /tbody -->
                                </table>
                                <!-- /table -->
                            </div>
                        </div>
                        
                    </div>


                    <div class="card width-60">                                                            
                        <table >
                            <thead>
                                <tr>
                                    <th><div class="cart-sub-total">Total Quantity :</div></th>
                                    <td><span class="inner-left-md"><?= $qtt ;?></span></td>
                                </tr>
                                <tr>
                                    <th><div class="cart-sub-total">Subtotal :</div></th>
                                    <td><span class="inner-left-md">$<?= $sum ;?></span></td>
                                </tr>
                                <tr>
                                    <th><div class="cart-sub-total"> VAT :</div></th>
                                    <td><span class="inner-left-md">10% ($<?php echo  $vat = $sum*0.1; ?>)</span></td>
                                </tr>

                                <tr>
                                    <th><div class="cart-grand-total"> Grand Total :</div></th>
                                    <td>
                                        <span class="inner-left-md">
                                            $<?php
                                            $vat = $sum*0.1;
                                            echo $grandTtl = $sum+$vat;
                                            session::set('grandTtl',$grandTtl);
                                            ?>
                                        </span>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <a href="shopping-cart.php" class="f-right cntu-shop btn btn-primary">Go to Cart</a>
                      
                </div>




            <div class="col-sm-5 f-right">
                <?php
                        $cmrId =   Session::get('cmrId');
                        $cInfo = $cmr->select($cmrId);
                        if($cInfo){
                            $result = $cInfo->fetch_assoc();
                            
                        ?>
                <div class="card">
                       <table class="table" style='margin-bottom:0px;'>
                           <tr style="border-bottom:1px solid #3333332b;">
                               <td colspan="2"><h2 style="text-align:center; margin: 0px;">Customer Details</h2></td>
                           </tr>
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
                        <?php }?>
                   </div>
                </div>
			</div><!-- /.row -->
            <div class="row">
                <div class="col-sm-12">
                    <a href="index.php" class="cntu-shop btn btn-primary">CONTINUE SHOPPING</a>
                    <a href="?actionOrder=order" class="f-right cntu-shop btn btn-primary">ORDER</a>
                </div>
            </div>
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<?php include "inc/footer.php";?>
