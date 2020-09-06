<?php
    if(!isset($_GET['id'])){
        echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
    }
?>
<?php include_once "inc/header.php";?>

<?php
     $crt = new cls_cart();
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $cartId = $_POST['cartId'];
            $quentaty = $_POST['quantity'];
            $updatecheck = $crt->updateCart($cartId, $quentaty);
         }


         if(isset($_GET['delid'])){
            $gatId = base64_decode($_GET['delid']);
            $delSuccess = $crt->delete($gatId);
            }
           

?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li class='active'>Shopping Cart</li>
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
                                                    
                                                    <!-- <a href='update' class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> -->
                                                   
                                                </span>
                                            </div>
                                            <!-- /.shopping-cart-btn -->
                                        </td>
                                    </tr>
                                </tfoot>
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
                                        <td class="romove-item"><a onclick="return confirm('Are you sure to delete!';" href="?delid=<?=base64_encode($addToCartResult['productId']);?>" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
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
                        </form>
                    </div>

                    <div class="col-md-6 col-sm-12 estimate-ship-tax">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /table -->
                    </div>
                    <!-- /.estimate-ship-tax -->

                    <div class="col-md-6 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Subtotal<span class="inner-left-md">$<?= $sum ;?></span>
                                        </div>
                                        <div class="cart-sub-total">
                                            VAT<span class="inner-left-md">10%</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Grand Total<span class="inner-left-md">
                                            $<?php
                                                $vat = $sum*0.1;
                                                echo $grandTtl = $sum+$vat;
                                                session::set('grandTtl',$grandTtl);
                                             ?>
                                             </span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a class="btn btn-primary" style="color:#fff; padding:8px, 10px;" href="checkout.php">PROCCED TO CHEKOUT</a>
                                            <span class="">Checkout with multiples address!</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <!-- /table -->
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