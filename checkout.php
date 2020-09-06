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
</style>
<div class="body-content outer-top-bd">
	<div class="container">
		<div class="x-page inner-bottom-sm">
			<div class="row">
				<div class="width-800">
          <div class="card">
              <h4>Choose Payment Method</h4>
              <div class="mb-30">
                  <a href="OnlinePayment.php" class="btn btn-info">Online Payment</a>
                  <a href="OfflinePayment.php" class="btn btn-danger">Offline Payment</a> <br>
              </div>
              <a class="pback" href="shopping-cart.php"><<--- Back</a>
          </div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
	</div><!-- /.container -->
</div><!-- /.body-content -->
<?php include "inc/footer.php";?>
