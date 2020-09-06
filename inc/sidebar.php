
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <div class="side-menu animate-dropdown outer-bottom-xs">
        <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
            <nav class="yamm megamenu-horizontal">
                <ul class="nav">
                <?php 
                    $catdata = $cat->showCatagory();   
                        if($catdata){
                            while($catResult = $catdata->fetch_assoc()){

                        ?>
                    <li> <a href="category.php?id=<?=base64_encode($catResult['id']);?>"><i class="icon fa fa-shopping-bag"></i><?=ucfirst($catResult['catagoryName']);?></a></li>
                            <?php } } ?>
                </ul>
                <!-- /.nav -->
            </nav>
        <!-- /.megamenu-horizontal -->
    </div>
    <!-- /.side-menu -->
    <!-- ================================== TOP NAVIGATION : END ================================== -->

</div>