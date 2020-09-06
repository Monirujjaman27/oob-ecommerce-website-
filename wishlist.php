<?php
    // if(!isset($_GET['id'])){
    //     echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
    // }
?>
<?php include_once "inc/header.php";?>
<style>
.romove-item a i{color:#108bea;}
.text-danger {color: red !important; margin-left: 15px;}
</style>
<?php

    if(isset($_GET['addctId'])){
            $addctId = base64_decode($_GET['addctId']);
            $cmrId =   Session::get("cmrId");
            $delwishdata = $product->addcartfrmWish($addctId, $cmrId);
        
    }


    if(isset($_GET['delid'])){
    $cmrId =   Session::get("cmrId");
    $gatId = base64_decode($_GET['delid']);
    $delSuccess = $product->delwishdata($gatId,$cmrId );
    }
    
?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li class='active'>Wishlist Cart</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
<?php 
    if(isset($updatecheck)){
        echo $updatecheck;
    }
?>
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <div class="shopping-cart-table ">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="">Serial No</th>
                                        <th class="cart-description item">Image</th>
                                        <th class="cart-product-name item">Product Name</th>
                                        <th class="cart-product-name item">Price</th>
                                        <th class="cart-qty item">Quantity</th>
                                        <th class="cart-total last-item">Total</th>
                                        <th class="cart-romove item">Remove</th>
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
                                        $cmrId =   Session::get("cmrId");
                                        $data = $product->selectwishlist($cmrId);
                                        $i=0;
                                        $sum = 0;
                                        $qtt = 0;

                                        if($data){
                                            while($addToCartResult = $data->fetch_assoc()){
                                                $i++;
                                    ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td class="cart-image">
                                            <a class="entry-thumbnail" href="details.php?id=<?=base64_encode($addToCartResult['productId']);?>">
                                                <img height="100" width="100" src="Admin/upload/<?=$addToCartResult['image'];?>" alt="">
                                            </a>
                                        </td>
                                        <td class="cart-product-name-info">
                                            <h4 class='cart-product-description'><a href="details.php?id=<?=base64_encode($addToCartResult['productId']);?>"><?=$addToCartResult['productName'];?></a></h4>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="rating rateit-small"></div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="reviews">
                                                        (06 Reviews)
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td><?=$addToCartResult['price'];?></td>
                                        
                                        <form action="" method="POST">
                                            <td class="cart-product-quantity">
                                                <div class="quant-input">
                                                
                                                    <input type="hidden" name="cartId" value="<?=$addToCartResult['productId'];?>">
                                                    <input type="number" name="quantity" value="<?=$addToCartResult['quantity'];?>"style="border: 1px solid rgba(128, 124, 130, 0.56);">
                                            
                                                </div>
                                                <input class="btn btn-upper btn-primary pull-right outer-right-xs" type="submit" value="Update">
                                            </td>
                                        </form>
    
                                        <td class="cart-product-grand-total"><span class="cart-grand-total-price">$
                                        <?php
                                        $total = $addToCartResult['quantity']*$addToCartResult['price'];
                                        echo $total;
                                        ?>
                                        </span>
                                        </td>
                                        <td class="romove-item">
                                            <a onclick="return confirm('Are you sure to delete!';" href="?addctId=<?=base64_encode($addToCartResult['productId']);?>" title="cancel" class="icon"> <i class="glyphicon glyphicon-shopping-cart"></i> </a>
                                            <a onclick="return confirm('Are you sure to delete!';" href="?delid=<?=base64_encode($addToCartResult['productId']);?>" title="cancel" class="icon"><i class="fa fa-trash-o text-danger"></i></a>
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


                    <!-- /.cart-shopping-total -->
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