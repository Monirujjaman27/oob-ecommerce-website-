<?php include 'inc/header.php';?>
<style>
    .warning {
	color: red;
	padding: 10px;
	margin-left: 0px;
	font-size: 20px;
}

    .success{
	color: #18bd39;
	padding: 10px;
	margin-left: 0px;
    font-size: 20px;

}

</style>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="index.php">Home</a></li>
				<li class='active'>Compare</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<?php
    if(isset($_GET['addctId'])){
        $addctId = base64_decode($_GET['addctId']);
        $addct = $product->addcartfrmCompire($addctId);
    
    }
?>
<div class="body-content outer-top-xs">
	<div class="container">
    <div class="product-comparison">
		<div>
			<h1 class="page-title text-center heading-title">Product Comparison</h1>
			<?php if(isset($addct)){echo $addct;}?>
			<div class="table-responsive">

				<table class="table compare-table inner-top-vs">


					<tr>
						<th>Products</th>
            <?php 
               $data = $product->checkCmprTbl();
               if($data){
                 while($Result = $data->fetch_assoc()){?>
						<td>
							<div class="product">
								<div class="product-image">
									<div class="image">
										<a href="details.php?id=<?=base64_encode($Result['productId']);?>">
										    <img alt="" src="Admin/upload/<?=$Result['image'];?>">
										</a>
									</div>

									<div class="product-info text-left">
										<h3 class="name"><a href="details.php?id=<?=base64_encode($Result['productId']);?>"><?=$Result['productName'];?></a></h3>
										<div class="action">
										    <a class="lnk btn btn-primary" href="?addctId=<?=base64_encode($Result['productId']);?>">Add To Cart</a>
										</div>

									</div>
								</div>
							</div>
						</td>
            <?php } }?>

					</tr>

					<tr>

						<th>Price</th>
						<?php 
						$data = $product->checkCmprTbl();
						if($data){
							while($Result = $data->fetch_assoc()){?>
						<td>
							<div class="product-price">
								<span class="price"> $<?=$Result['price'];?></span>
								<span class="price-before-discount">$<?php $ttl = $Result['price']+$Result['discount']; echo $ttl?></span>
							</div>
						<?php } }?>
						</td>


					</tr>

					<tr>
						<th>Description</th>
						<?php 
							$data = $product->checkCmprTbl();
							if($data){
							while($Result = $data->fetch_assoc()){?>
						<td><p class="text"><?=$Result['description'];?>.<p></td> 
					
						<?php } }?>
					</tr>

					<tr>
				<th>Availability</th>
				<?php 
					$data = $product->checkCmprTbl();
					if($data){
						while($Result = $data->fetch_assoc()){?>

                <td><p class="in-stock"><?=$Result['availability'];?></p></td>
				<?php } }?>

					</tr>

					<tr >
						<th>Remove</th>
						<?php
						
							if(isset($_GET['delid'])){
								$gatId = base64_decode($_GET['delid']);
								$delSuccess = $product->deleteCmprData($gatId);
								}


								$data = $product->checkCmprTbl();
								if($data){
									while($Result = $data->fetch_assoc()){
								
						?>
						<td class='text-center'>
							 <a onclick="return confirm('Are you sure to Remove from Comparison!';" href="?delid=<?=base64_encode($Result['id']);?>" title="Remove" class="icon"><i class="fa fa-trash-o text-danger"></i></a>
						</td>
				<?php } }?>

					</tr>

				</table>
			</div>
        <div style="float: right; margin-bottom:15px;">
          <a href="index.php" class="btn btn-upper btn-primary outer-left-xs" style="font-size: 18px; float-right">Continue Shopping</a>
     
        </div>
      </div>
		</div>
	</div>
</div>
<?php include 'inc/footer.php';?>
