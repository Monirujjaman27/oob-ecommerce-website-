<?php include "inc/header.php";?>
<?php
  $login =   Session::get("cmrLogin");
  if($login == false){
    echo "<script>window.location='login.php';</script>";

  }
    
?>
<style>
  .width-800 {width: 500px; text-align: center; margin: auto;}
  .card{padding:40px 60px 40px;}
  .card h4{border-bottom:.5px solid #33333382; padding-bottom:30px;  margin-bottom:30px;}
  .mb-30{ margin-bottom:30px;}
  .pback{float:left;}
  .f-right{float:right;}
  .f-size-16{font-size:16px;}
</style>
<div class="body-content outer-top-bd">
	<div class="container">
		<div class="x-page inner-bottom-sm">
			<div class="row">
				<div class="width-800">
          <div class="card">
              <h4>Order Success</h4>
              <?php 
               $cmrId = Session::get('cmrId');
               $ordersuccessData = $cmr->getOrderData($cmrId);
               $sum = 0;
               $qtt = 0;
               if($ordersuccessData){
                  while($result = $ordersuccessData->fetch_assoc()){
                   
                    $price = $result['price']*$result['quantity'];
                    $sum  = $sum+$price;
                    $qtt =  $qtt + $result['quantity'];



                  }
               }

              
              ?>
              <p class="f-size-16">Total Payable amount (Including Vat)$
              <?php
                $vat  = $sum  * 0.1;
                echo $vat + $sum ;
              ?> 
              of 
              <?php echo  $qtt;?> Produce. 
              Thank you for Purchase. we will Contact You ASAP with delevery details. Heare is your 
               <a href="delevery-detailse.php">Order details....</a>
              </p>
              
              </div>
              <a class="pback btn btn-info f-right" href="index.php">Continue Shopping</a>
          </div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<?php include "inc/footer.php";?>
