
<?php
    include 'lib/session.php';
    session::init();
    include 'lib/database.php';
    include 'halpers/formet.php';
    spl_autoload_register(function($classes){
        include_once "classes/".$classes.".php";
    });
    $db       = new database();
    $fm       = new Format();
    $cat      = new catagory();
    $brand    = new brand();
    $product  = new Product();
    $cart     = new Cls_cart();
    $cmr      = new Customer();




?>
<?php 
    if(isset($_GET['cid'])){
        $cart->delCrtData();
        Session::cmrlogindestroy();
        echo "<script>window.location='login.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>eCommerce premium HTML5 & CSS3 Template</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/blue.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <header class="header-style-1">
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            <?php
                                $login =   Session::get("cmrLogin");
                                if($login == TRUE){?>
                                    <li><a style="font-size:15px;" href="profile.php"><i class="icon fa fa-user"></i>Profile</a></li>
                            <?php }?>

                            <?php
                                $login =   Session::get("cmrLogin");
                                if($login == TRUE){
                                $cmrId =   Session::get("cmrId");
                                $checkorderTbl =   $cmr->getOrderdetails($cmrId);
                                if($checkorderTbl){?>
                                    <li><a href="delevery-detailse.php"><i class="icon fa fa-check"></i>Order Details</a></li>
                         <?php } }?>
                            <?php
                                $login =   Session::get("cmrLogin");
                                if($login == TRUE){
                                $cmrId =   Session::get("cmrId");
                                $checwishlist =   $product->selectwishlist($cmrId);
                                if($checwishlist){?>
                                    <li><a href="wishlist.php"><i class="icon fa fa-check"></i>Wishlist</a></li>
                         <?php } }?>

                            <?php
                                $checkCmprTbl =   $product->checkCmprTbl();
                                if($checkCmprTbl){?>
                                    <li><a href="product-comparison.php"><i class="icon fa fa-check"></i>Compare</a></li>
                         <?php }?>

                            <?php
                                $ckCrtTbl =   $cart->checkTbl();
                                if($ckCrtTbl){?>
                                    <li><a href="shopping-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                                    <li><a href="checkout.php"><i class="icon fa fa-check"></i>Checkout</a></li>
                         <?php }?>

                           
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 logo-holder">
                        <div class="logo">
                            <a href="index.php"> <img src="assets/images/logo.png" alt="logo"> </a>
                        </div>
                    </div>




                    <div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
                        <div style="float:right;" class="dropdown dropdown-cart">
                            <a href="shopping-cart.php" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                                <div class="items-cart-inner">
                                        <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                        
                                               
                                        <div class="basket-item-count"><span class="count">
                                        <?php
                                        $data = $cart->selectCrtProduct();
                                        $sum = 0;
                                        $qtt= 0;
                                          if($data){
                                              while($r = $data->fetch_assoc()){
                                                $total = $r['quantity']*$r['price'];
                                                $sum = $sum + $total;
                                                $gqtt = $r['quantity'];
                                                $tqtt = $qtt + $gqtt;
                                              }
                                          }
                                          
                                         ?>
                                         <?php if(isset($tqtt)){echo $tqtt;}?>
                                        </span></div>
                                        <div class="total-price-basket"> <span class="lbl">CRT-</span> 
                                            <span class="total-price"> <span class="sign">$</span><span class="value">
                                           <?php 
                                            
                                            $vat = $sum*0.1;
                                            echo $grandTtl = $sum+$vat;
                                           ?>
                                            </span>

                                            </span> 
                                        </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="cart-item product-summary">

                                    <?php 
                                        $tdata = $cart->selectCrtProduct();
                                        $sum = 0;
                                        $qtt = 0;
                                        if($tdata){
                                            while($addToCartResult = $tdata->fetch_assoc()){
                                    ?>
                                        <div class="row" style="margin-top:8px;">
                                            <div class="col-xs-4">
                                                <div class="image">
                                                    <a href="shopping-cart.php"><img src="Admin/upload/<?=$addToCartResult['image'];?>" alt=""></a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-7">
                                                <h3 class="name"><a href="shopping-cart.php"><?=$addToCartResult['productName'];?></a></h3>
                                                <div class="price">$<?php 
                                                $total = $addToCartResult['quantity']*$addToCartResult['price'];
                                                     echo $total;?></div>
                                            </div>
                                        </div>
                                        <?php
                                         $sum = $sum + $total;
                                         $tqtt = $qtt + $addToCartResult['quantity'];
                                        session::set('tqtt', $tqtt);

                                         }}
                                    ?>

                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="clearfix cart-total">
                                        <div class="pull-right"> <span class="text">Sub Total :</span><span class='price'>$<?= $sum ;?></span> </div>
                                        <div class="pull-right"> <span class="text">VAT:       </span><span class="inner-left-25">10% <?php echo  $vat = $sum*0.1;?></span></span> </div>
                                        <br>
                                        <br>
                                        <hr style="margin:5px;">
                                        <div class="pull-right"> <strong style="margin-right:0px;" class="text"> Grand Total: $
                                        <?php 
                                            $vat = $sum*0.1;
                                            echo $ttl = $sum+$vat; 
                                            session::set('ttl',$ttl);
                                        
                                        ?>
                                        </strong> </div>
                                        <div class="clearfix"></div>
                                        <?php
                                            $ckCrtTbl =   $cart->checkTbl();
                                            if($ckCrtTbl){?>
                                        <a href="checkout.php" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> </div>
                                            <?php }?>
                                    </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-1 animate-dropdown top-cart-row">
                        <?php
                            $login =   Session::get("cmrLogin");
                            if($login == FALSE){?>
                            <a style="padding: 13px; background: #006cb4; border: 1px solid #24609c; border-radius: 3px; display: inline-block; color: #fff; float:right;" href="login.php"><i class="icon fa fa-lock"></i> Login</a>

                        <?php }else{?>
                            <a style="padding:13px 10px; background: #006cb4; border: 1px solid #24609c; border-radius: 3px; display: inline-block; color: #fff; float:right;" href="?cid=<?php Session::get('cmrId');?>"><i class="icon fa fa-lock"></i> Log Out</a>
                            <?php } ?>
                    </div>



                </div>
            </div>
            <div class="header-nav animate-dropdown">
                <div class="container">
                    <div class="yamm navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                        </div>
                        <div class="nav-bg-class">
                            <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                                <div class="nav-outer">
                                    <ul class="nav navbar-nav">
                                        <li class="active dropdown yamm-fw"> <a href="index.php" data-hover="dropdown" >Home</a> </li>
                                        <li class="dropdown mega-menu">
                                            <a href="category.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Electronics <span class="menu-label hot-menu hidden-xs">hot</span> </a>
                                            <ul class="dropdown-menu container">
                                                <li>
                                                    <div class="yamm-content">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                                <h2 class="title">Laptops</h2>
                                                                <ul class="links">
                                                                    <li><a href="#">Gaming</a></li>
                                                                    <li><a href="#">Laptop Skins</a></li>
                                                                    <li><a href="#">Apple</a></li>
                                                                    <li><a href="#">Dell</a></li>
                                                                    <li><a href="#">Lenovo</a></li>
                                                                    <li><a href="#">Microsoft</a></li>
                                                                    <li><a href="#">Asus</a></li>
                                                                    <li><a href="#">Adapters</a></li>
                                                                    <li><a href="#">Batteries</a></li>
                                                                    <li><a href="#">Cooling Pads</a></li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.col -->

                                                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                                <h2 class="title">Desktops</h2>
                                                                <ul class="links">
                                                                    <li><a href="#">Routers & Modems</a></li>
                                                                    <li><a href="#">CPUs, Processors</a></li>
                                                                    <li><a href="#">PC Gaming Store</a></li>
                                                                    <li><a href="#">Graphics Cards</a></li>
                                                                    <li><a href="#">Components</a></li>
                                                                    <li><a href="#">Webcam</a></li>
                                                                    <li><a href="#">Memory (RAM)</a></li>
                                                                    <li><a href="#">Motherboards</a></li>
                                                                    <li><a href="#">Keyboards</a></li>
                                                                    <li><a href="#">Headphones</a></li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.col -->

                                                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                                <h2 class="title">Cameras</h2>
                                                                <ul class="links">
                                                                    <li><a href="#">Accessories</a></li>
                                                                    <li><a href="#">Binoculars</a></li>
                                                                    <li><a href="#">Telescopes</a></li>
                                                                    <li><a href="#">Camcorders</a></li>
                                                                    <li><a href="#">Digital</a></li>
                                                                    <li><a href="#">Film Cameras</a></li>
                                                                    <li><a href="#">Flashes</a></li>
                                                                    <li><a href="#">Lenses</a></li>
                                                                    <li><a href="#">Surveillance</a></li>
                                                                    <li><a href="#">Tripods</a></li>
                                                                </ul>
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-xs-12 col-sm-12 col-md-2 col-menu">
                                                                <h2 class="title">Mobile Phones</h2>
                                                                <ul class="links">
                                                                    <li><a href="#">Apple</a></li>
                                                                    <li><a href="#">Samsung</a></li>
                                                                    <li><a href="#">Lenovo</a></li>
                                                                    <li><a href="#">Motorola</a></li>
                                                                    <li><a href="#">LeEco</a></li>
                                                                    <li><a href="#">Asus</a></li>
                                                                    <li><a href="#">Acer</a></li>
                                                                    <li><a href="#">Accessories</a></li>
                                                                    <li><a href="#">Headphones</a></li>
                                                                    <li><a href="#">Memory Cards</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-4 col-menu custom-banner">
                                                                <a href="#"><img alt="" src="assets/images/banners/banner-side.png"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </ul>
                                            </li>
                                            <li class="dropdown hidden-sm"> <a href="category.html">Health & Beauty <span class="menu-label new-menu hidden-xs">new</span> </a> </li>
                                            <li class="dropdown hidden-sm"> <a href="category.html">Watches</a> </li>
                                            <li class="dropdown"> <a href="contact.html">Jewellery</a> </li>
                                            <li class="dropdown"> <a href="contact.html">Shoes</a> </li>
                                            <li class="dropdown"> <a href="contact.html">Kids & Girls</a> </li>
                                            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="home.html">Home</a></li>
                                                                        <li><a href="category.html">Category</a></li>
                                                                        <li><a href="detail.html">Detail</a></li>
                                                                        <li><a href="shopping-cart.html">Shopping Cart Summary</a></li>
                                                                        <li><a href="checkout.html">Checkout</a></li>
                                                                        <li><a href="blog.html">Blog</a></li>
                                                                        <li><a href="blog-details.html">Blog Detail</a></li>
                                                                        <li><a href="contact.html">Contact</a></li>
                                                                        <li><a href="sign-in.html">Sign In</a></li>
                                                                        <li><a href="my-wishlist.html">Wishlist</a></li>
                                                                        <li><a href="terms-conditions.html">Terms and Condition</a></li>
                                                                        <li><a href="track-orders.html">Track Orders</a></li>
                                                                        <li><a href="product-comparison.html">Product-Comparison</a></li>
                                                                        <li><a href="faq.html">FAQ</a></li>
                                                                        <li><a href="404.html">404</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>