<?php include_once "inc/header.php";?>
<?php
  $login =   Session::get("cmrLogin");
  if($login == false){
    echo "<script>window.location='login.php';</script>";

  }
    
?>


<style>.body-content .my-wishlist-page .my-wishlist table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	vertical-align: middle;
	border: none;
	padding: 5px;}
</style>



<?php 
    if(isset($_GET['delid'])){
    $cmrId =   Session::get("cmrId");
    $gatId = base64_decode($_GET['delid']);
    $delsuccess = $cmr->delorderData($gatId, $cmrId);
    }
    ?>
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li class='active'>Order details</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width='' class="cart-description item">Serial No</th>
                                        <th width='' class="cart-description item">Time</th>
                                        <th width='' class="cart-description item">Image</th>
                                        <th width='' class="cart-product-name item">Product Name</th>
                                        <th width='' class="cart-product-name item">Price</th>
                                        <th width='' class="cart-qty item">Quantity</th>
                                        <th width='' class="cart-total last-item">Total</th>
                                        <th width='' class="cart-romove item">Status</th>
                                        <th width='' class="cart-romove item">Action</th>
                                    </tr>
                                </thead>
                                <!-- /thead -->
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="shopping-cart-btn">
                                                <span class="">
                                                    <a href="index.php" class="btn btn-upper btn-primary outer-left-xs" style="font-size: 18px;">Continue Shopping</a>
                                                    <?php ?>
                                                    <!-- <a href='update' class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> -->
                                                   
                                                </span>
                                            </div>
                                            <!-- /.shopping-cart-btn -->
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                        $cmrId = Session::get('cmrId');
                                        $orderdtls = $cmr->getOrderdetails($cmrId);
                                        $i=0;
                                        if($orderdtls){
                                            while($detsilsResult = $orderdtls->fetch_assoc()){
                                                $i++;
                                    ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td>
                                            <?=$detsilsResult['dateTime'];?>
                                        </td>
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="details.php?id=<?=base64_encode($detsilsResult['productId']);?>">
                                                <img height="25" width="25" src="Admin/upload/<?=$detsilsResult['image'];?>" alt="">
                                            </a>
                                        </td>
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'><a href="details.php?id=<?=base64_encode($detsilsResult['productId']);?>"><?=$detsilsResult['ProductName'];?></a></h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="rating rateit-small"></div>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td>$<?=$detsilsResult['price'];?></td>
                                        
                                        <form action="" method="POST">
                                            <td class="cart-product-quantity">
                                                <div class="quant-input">
                                                    <?=$detsilsResult['quantity'];?>
                                            
                                                </div>
                                            </td>
                                        </form>
    
                                        <td class="cart-product-grand-total"><span class="cart-grand-total-price">$
                                        <?php
                                        $total = $detsilsResult['quantity']*$detsilsResult['price'];
                                        echo $total;
                                        ?>
                                        </span>
                                        </td>
                                        <td>
                                                <?php
                                                    if($detsilsResult['status'] == 0 && $detsilsResult['NA'] == 0){
                                                        echo "Panding";
                                                    }elseif($detsilsResult['status'] == 0 && $detsilsResult['NA'] == 1){
                                                        echo 'N/A';
                                                    }else{
                                                        echo '<i class="fa fa-check"></i>';
                                                    }
                                                ?>
                                        </td>

                                        <td class="romove-item">
                                            <a onclick="return confirm('Are you sure to Remove This Product!')" href="?delid=<?=base64_encode($detsilsResult['id']);?>" title="Remove" class="icon"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php 

                                        } }else{
                                            echo "<script>window.location='index.php';</script>";
                                        }
                                    ?>
                                </tbody>
                                <!-- /tbody -->
                            </table>
                            <!-- /table -->
                        </div>
                        </form>
                    </div>

                </div>
                <!-- /.shopping-cart -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">

                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item m-t-10">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image">
                                <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
                            </a>
                        </div>
                        <!--/.item-->
                    </div>
                    <!-- /.owl-carousel #logo-slider -->
                </div>
                <!-- /.logo-slider-inner -->

            </div>
            <!-- /.logo-slider -->
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->
<?php include "inc/footer.php";?>
    <script>
        $(document).ready(function() {
            $(".changecolor").switchstylesheet({
                seperator: "color"
            });
            $('.show-theme-options').click(function() {
                $(this).parent().toggleClass('open');
                return false;
            });
        });

        $(window).bind("load", function() {
            $('.show-theme-options').delay(2000).trigger('click');
        });
    </script>
</body>

</html>