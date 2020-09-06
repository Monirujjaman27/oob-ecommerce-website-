<?php include "inc/header.php";?>
<?php
  $login =   Session::get("cmrLogin");
  if($login == true){
    echo "<script>window.location='shopping-cart.php';</script>";
  }
    
?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li class='active'>Login</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $clogin = $cmr->cmrlogin($_POST);
    }

?>
    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Sign in</h4>
                        <p class="">Hello, Welcome to your account.</p>
                        <p class="text title-tag-line" style="color:red;">
                            <?php 
                                if(isset($clogin)){
                                        echo $clogin;
                                    }
                            ?>
                        </p>
                        <form class="register-form outer-top-xs" role="form" method="POST" action="">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                                <input type="email" name="lemail" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                                <input type="password" name="lpass" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
                            </div>
                            <!-- <div class="radio outer-xs">
                                <label>
                                    <input type="radio" name="Remember" id="optionsRadios2" value="option2">Remember me!
                                </label>
                                <a href="forgetPass.php" class="forgot-password pull-right">Forgot your Password?</a>
                            </div> -->
                            <button type="submit" name="login" title="Login" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        </form>
                    </div>
                    <!-- Sign-in -->
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reg'])){
                            $cReg = $cmr->insert($_POST);
                        }

                    ?>
                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">Create a new account</h4>
                        <p class="text title-tag-line" style="color:red;">
                            <?php 
                                if(isset($cReg)){
                                        echo $cReg;
                                    }
                            ?>
                        </p>
                        <form class="register-form outer-top-xs" role="form" method="POST" action="">
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Username <span>*</span></label>
                                <input type="text" placeholder="User Name" value="<?php if(isset($_POST['uname'])){echo $_POST['uname'];}?>" name="uname" class="form-control unicase-form-control text-input" id="exampleInputEmail2">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"  name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail2">
                            </div>
                            <div class="form-group">
                                <label class="info-title"  name="pass" for="exampleInputEmail1">Password <span>*</span></label>
                                <input type="password" placeholder="Password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];}?>" name="pass" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title"  name="country" for="exampleInputEmail1">Country <span>*</span></label>
                                <input type="text" placeholder="Country" value="<?php if(isset($_POST['country'])){echo $_POST['country'];}?>" name="country" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title"  name="city" for="exampleInputEmail1">City <span>*</span></label>
                                <input type="text" placeholder="City" value="<?php if(isset($_POST['city'])){echo $_POST['city'];}?>" name="city" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title"  name="phone" for="exampleInputEmail1">Phone <span>*</span></label>
                                <input type="phone" placeholder="Phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>" name="phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label class="info-title"  name="zipCode" for="exampleInputEmail1">ZipCode <span>*</span></label>
                                <input type="zipCode" placeholder="ZipCode" value="<?php if(isset($_POST['zipCode'])){echo $_POST['zipCode'];}?>" name="zipCode" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                            </div>
                            <button type="submit"  name="reg" title="Sign Up" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                        </form>

                    </div>
                    <!-- create a new account -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.sigin-in-->
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
