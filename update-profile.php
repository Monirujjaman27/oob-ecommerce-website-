<?php include "inc/header.php";?>
<?php
  $login =   Session::get("cmrLogin");
  if($login == false){
    echo "<script>window.location='login.php';</script>";
  }


 
?>

    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li class='active'>Profile</li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addnewPic'])){
            $cmrId =   Session::get('cmrId');
            $addnewPic = $cmr->updateProPic($_FILES, $cmrId);
            
        }
    ?>
      <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cngProPic'])){
            $cmrId =   Session::get('cmrId');
            $cngProPic = $cmr->updateProPic($_FILES, $cmrId);
            
        }
    ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['infoUpdate'])){
            $cmrId =   Session::get('cmrId');
            $infoUpdate = $cmr->infoUpdate($_POST, $cmrId);
            
        }
    ?>

    <div class="body-content">
        <div class="container">
                <div class="row">
                   <?php
                    if(isset($addnewPic)){
                       echo $addnewPic;
                   } 
                    if(isset($cngProPic)){
                       echo $cngProPic;
                   } 
                    if(isset($profileUpdate)){
                       echo $profileUpdate;
                   } 
                    if(isset($infoUpdate)){
                       echo $infoUpdate;
                   } 
                   ?>
                     <?php
                        $login =   Session::get("cmrLogin");
                        if($login == true){
                            
                            $cmrId  =   Session::get('cmrId');
                            $cInfo  =   $cmr->select($cmrId);
                            $result =   $cInfo->fetch_assoc();
                            
                        ?>
                          
                    <div class="col-md-3 col-sm-3" style="">
                        <?php
                            if(($result['image']) == true){?>
                         
                         
                            <div class="card">
                                 <img height="100%" width="100%" src="admin/upload/profile/<?php if(isset($result['image'])){echo $result['image'];}?>" alt="Profile">
                            </div>
                            <div>
                            
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <label for="cngPpr">Change Profile picture:</label>
                                    <input type="file" name="addproPic" id="cngPpr"></td>
                                    <input type="submit" name="cngProPic" value="Change">
                                </form>
                            </div>
                            <?php } else{?>
                                <div class="card" style="padding:20px;">
                                <form action="" method="POST" enctype="multipart/form-data">
                                        <label for="cngPpr">Add Profile picture:</label>
                                        <input type="file" name="addproPic" id="cngPpr"></td>
                                        <input type="submit" name="addnewPic" value="Add">
                                </form> 
                             </div>
                            <?php }?>
                    </div>
                    <div class="col-md-6 col-sm-6" style="">
                        <div class="card">
                            <form action="" method="POST">
                                <table class="table">
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td colspan="2"><h2 style="text-align:center; margin: 0px;">Update User Details</h2></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td width="30%">User Name:</td>
                                        <td width="70%"><input  class="form-control " type="text" name="uname" value="<?=$result['uname'];?>"></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td>Email:</td>
                                        <td><input class="form-control " type="text" name="email" value="<?=$result['email'];?>"> </td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td>Country:</td>
                                        <td><input  class="form-control " type="text" name="country" value="<?=$result['country'];?>"></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td>City:</td>
                                        <td><input  class="form-control " type="text" name="city" value="<?=$result['city'];?>"></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td>Phone:</td>
                                        <td><input  class="form-control " type="text" name="phone" value="<?=$result['phone'];?>"></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid #3333332b;">
                                        <td>Zip Code:</td>
                                        <td><input  class="form-control " type="text" name="zipCode" value="<?=$result['zipCode'];?>"></td>
                                    </tr>
                    
                                    <tr>
                                        <td colspan="2" style="text-align:center;"><input class="btn btn-info" name="infoUpdate" type="submit" value="Update"></td>
                                        <td colspan="2" style="text-align:center;"><a class="btn btn-info" href="profile.php">Back</a></td>
                                    </tr>
                                    
                                </table>
                            </form>
                        </div>
                    </div>
                    <?php  }?>
                <!-- /.col -->
                </div>
            <!-- /.row -->
         </div>
        <!-- /.container -->
    </div>
    <!-- /.body-content -->
    
<?php include "inc/footer.php";?>
