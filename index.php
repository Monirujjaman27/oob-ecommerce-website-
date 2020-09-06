<?php include 'inc/header.php';?>
<?php include 'inc/slider.php';?>
<style>
    .cart-white{color:black;}
    .cart-white:hover{color:#fff;}
    .text-warning{color:yellow;}
    .warning {
	color: red;
	padding: 10px;
	margin-left: 20px;
	font-size: 20px;
}

    .success{
	color: #18bd39;
	padding: 10px;
	margin-left: 20px;
    font-size: 20px;

}

</style>
<?php
    if(isset($_GET['addctId'])){
        $addctId = base64_decode($_GET['addctId']);
        $addct = $cart->addtocart($addctId);
    
    }

    if(isset($_GET['addWishlist'])){
        $cmrId =   Session::get("cmrId");
        $addWishlist = base64_decode($_GET['addWishlist']);
        $getwishlist = $product->getwishlist($addWishlist, $cmrId);
        
    }

    if(isset($_GET['compireId'])){
        $addcompireId = base64_decode($_GET['compireId']);
        $getcompire = $product->getCompire($addcompireId);
        
    }
?>
<?php
    if(isset($_GET['addnewctId'])){
        $addnewctId = base64_decode($_GET['addnewctId']);
        $addnewct = $cart->addtocart($addnewctId);
    
    }

    if(isset($_GET['addnewWishlist'])){
        $cmrId =   Session::get("cmrId");
        $addnewWishlist = base64_decode($_GET['addnewWishlist']);
        $getnewwishlist = $product->getwishlist($addnewWishlist, $cmrId);
        
    }

    if(isset($_GET['newcompireId'])){
        $addcompireId = base64_decode($_GET['newcompireId']);
        $getnewcompire = $product->getCompire($addcompireId);
        
    }
?>
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">New Products</h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                                <li><a data-transition-type="backSlide" href="#smartphone" data-toggle="tab">Clothing</a></li>
                                <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                                <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>
                            </ul>
                            <!-- /.nav-tabs -->
                        </div>
                                <?php if(isset($addnewct)){echo $addnewct;}?>
                                <?php if(isset($getnewwishlist)){echo $getnewwishlist;}?>
                                <?php if(isset($getnewcompire)){echo $getnewcompire;}?>
                        <div class="tab-content outer-top-xs">
                            <div class="tab-pane in active" id="all">
                                <div class="product-slider">
                                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <?php 
                                        $data = $product->getProFornew();   
                                            if($data){
                                                while($newPro = $data->fetch_assoc()){
                                            ?>
                                            <form action="" method="POST">
                                                <div class="item item-carousel">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image">
                                                                    <a href="detail.html"><img height="189" width='189' src="Admin/upload/<?=$newPro['thumbnail'];?>" alt=""></a>
                                                                </div>
                                                                <!-- /.image -->

                                                                <div class="tag new"><span>new</span></div>
                                                            </div>
                                                            <!-- /.product-image -->

                                                            <div class="product-info text-left">
                                                                <h3 title="Product Title" class="name"><a href="details.php?id=<?=base64_encode($newPro['id']);?>"><?=$newPro['title'];?></a></h3>
                                                                <div class="rating rateit-small"></div>
                                                                <div class="description">
                                                                <?=$fm->textShorten($newPro['body'], 45);?>
                                                                <span><a href="details.php?id=<?=base64_encode($newPro['id']);?>">Read More</a></span></div>

                                                                <div class="product-price"> <span class="price"> $<?=$newPro['price'];?></span> <span class="price-before-discount">$<?php $ttl = $newPro['price']+$newPro['discount']; echo $ttl?></span> </div>
                                                                <!-- /.product-price -->

                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                               
                                                                        <li class="add-cart-button btn-group">
                                                                            <button class="btn btn-primary icon" data-toggle="tooltip" type="button" title="Add Cart"><a class="cart-white" href="?addnewctId=<?=base64_encode($newPro['id']);?>"> <i class="fa fa-shopping-cart"></i></a></button>
                                                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                        </li>
                                                                        <?php
                                                                        $login =   Session::get("cmrLogin");
                                                                        if($login == TRUE){?>
                                                                        <li class="lnk wishlist">
                                                                            <a class="add-to-cart" href="?addnewWishlist=<?=base64_encode($newPro['id']);?>" data-toggle="tooltip" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                                        </li>
                                                                        <?php }?>
                                                                        <li class="lnk">
                                                                            <a class="add-to-cart" href="?newcompireId=<?=base64_encode($newPro['id']);?>" data-toggle="tooltip" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->
                                                        </div>
                                                        <!-- /.product -->

                                                    </div>
                                                    <!-- /.products -->
                                                </div>
                                            </form>
                                        <?php }}?>
                                       
                                    </div>
                                    <!-- /.home-owl-carousel -->
                                </div>
                                <!-- /.product-slider -->
                            </div>
                        </div>
                    </div>
                    <!-- Featured products -->
                    <section class="section featured-product wow fadeInUp">
                        <h3 class="section-title">Featured products</h3>
                        <?php if(isset($addct)){echo $addct;}?>
                       <?php if(isset($getwishlist)){echo $getwishlist;}?>
                       <?php if(isset($getcompire)){echo $getcompire;}?>
                         <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            <?php 
                               $data = $product->getProForFeatured();   
                                if($data){
                                    while($featuredPro = $data->fetch_assoc()){
                                ?>
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="details.php?id=<?=base64_encode($featuredPro['id']);?>"><img height="189" width='189' src="Admin/upload/<?=$featuredPro['thumbnail'];?>" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                       
                                            <h3 class="name"><a href="details.php?id=<?=base64_encode($featuredPro['id']);?>"><?=$featuredPro['title'];?></a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description">
                                            <?=$fm->textShorten($featuredPro['body'], 45);?>
                                                <span><a href="details.php?id=<?=base64_encode($featuredPro['id']);?>">Read More</a></span>
                                            </div>
                                            <div class="product-price"> <span class="price"> $<?=$featuredPro['price'];?> </span> <span class="price-before-discount">$ <?php $ttl = $featuredPro['price']+$featuredPro['discount']; echo $ttl?></span> </div>
                                            <!-- /.product-price -->
                                          
                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                               
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="tooltip" type="button" title="Add Cart"><a class="cart-white" href="?addctId=<?=base64_encode($featuredPro['id']);?>"> <i class="fa fa-shopping-cart"></i></a></button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <?php
                                                    $login =   Session::get("cmrLogin");
                                                    if($login == TRUE){?>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="?addWishlist=<?=base64_encode($featuredPro['id']);?>" data-toggle="tooltip" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <?php }?>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="?compireId=<?=base64_encode($featuredPro['id']);?>" data-toggle="tooltip" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                                    <?php }}?>

                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>

                    <div class="best-deal wow fadeInUp outer-bottom-xs">
                        <h3 class="section-title">Best seller</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p20.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p21.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p22.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p23.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p24.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p25.jpg" alt=""> </a>
                                                            </div>
                                                            <!-- /.image -->

                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                            <!-- /.product-price -->

                                                        </div>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-micro-row -->
                                            </div>
                                            <!-- /.product-micro -->

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="products best-product">
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p26.jpg" alt=""> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <a href="#"> <img src="assets/images/products/p27.jpg" alt=""> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2 col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="#">Floral Print Buttoned</a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price"> <span class="price"> $450.99 </span> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <section class="section wow fadeInUp new-arriavls">
                        <h3 class="section-title">New Arrivals</h3>
                        <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p19.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p28.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p30.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p1.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag hot"><span>hot</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p2.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->

                            <div class="item item-carousel">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="detail.html"><img src="assets/images/products/p3.jpg" alt=""></a>
                                            </div>
                                            <!-- /.image -->

                                            <div class="tag sale"><span>sale</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="detail.html">Floral Print Buttoned</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>
                                            <div class="product-price"> <span class="price"> $450.99 </span> <span class="price-before-discount">$ 800</span> </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist">
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                    </li>
                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            <!-- /.item -->
                        </div>
                        <!-- /.home-owl-carousel -->
                    </section>
                    <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                        <h3 class="section-title">latest form blog</h3>
                        <div class="blog-slider-container outer-top-xs">
                            <div class="owl-carousel blog-slider custom-carousel">
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image">
                                                <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Voluptatem accusantium doloremque laudantium</a></h3>
                                            <span class="info">By Jone Doe &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image">
                                                <a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image">
                                                <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image">
                                                <a href="blog.html"><img src="assets/images/blog-post/post2.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="blog-post">
                                        <div class="blog-post-image">
                                            <div class="image">
                                                <a href="blog.html"><img src="assets/images/blog-post/post1.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="blog-post-info text-left">
                                            <h3 class="name"><a href="#">Dolorem eum fugiat quo voluptas nulla pariatur</a></h3>
                                            <span class="info">By Saraha Smith &nbsp;|&nbsp; 21 March 2016 </span>
                                            <p class="text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>
                                            <a href="#" class="lnk btn btn-primary">Read more</a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
                <!-- /.homebanner-holder -->

                <?php include 'inc/sidebar.php';?>
                
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">
                <div class="logo-slider-inner">
                    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                        <div class="item m-t-15">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item m-t-10">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->

                        <div class="item">
                            <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt=""> </a>
                        </div>
                        <!--/.item-->
                    </div>
                    <!-- /.owl-carousel #logo-slider -->
                </div>
                <!-- /.logo-slider-inner -->

            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /#top-banner-and-menu -->
<?php include 'inc/footer.php';?>