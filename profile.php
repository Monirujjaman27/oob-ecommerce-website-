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
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $cmrId =   Session::get('cmrId');
                $profileUpdate = $cmr->updateProPic($_FILES, $cmrId);
            }


        ?>
    <div class="body-content">
        <div class="container">
                <div class="row">
                     <?php
                        $cmrId =   Session::get('cmrId');
                        $cInfo = $cmr->select($cmrId);
                        if($cInfo){
                            $result = $cInfo->fetch_assoc();
                            
                        ?>
                    <div class="col-md-3 col-sm-3" style="">
                         <?php 
                            if(($result['image']) == true){
                               
                         ?>
                            <div class="card">
                                 <img height="100%" width="100%" src="admin/upload/profile/<?php if(isset($result['image'])){echo $result['image'];}?>" alt="Profile">
                            </div>
                        <?php }else{?>
                            <div class="card" style="padding:20px;">
                                <form action="" method="POST" enctype="multipart/form-data">
                                        <label for="cngPpr">Add Profile picture:</label>
                                        <input type="file" name="addproPic" id="cngPpr"></td>
                                        <input type="submit" name="cngProPic" value="Add">
                                </form> 
                             </div>
                            <?php }?>
                    </div>
                    <div class="col-md-6 col-sm-6" style="">
                        <div class="card">
                       
                            <table class="table">
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td colspan="2"><h2 style="text-align:center; margin: 0px;">User Details</h2></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td width="30%">User Name:</td>
                                    <td width="70%"><?=$result['uname'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Email:</td>
                                    <td><?=$result['email'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Country:</td>
                                    <td><?=$result['country'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>City:</td>
                                    <td><?=$result['city'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Phone:</td>
                                    <td><?=$result['phone'];?></td>
                                </tr>
                                <tr style="border-bottom:1px solid #3333332b;">
                                    <td>Zip Code:</td>
                                    <td><?=$result['zipCode'];?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align:center;"><a class="btn btn-info" href="update-profile.php">Udate Profile</a></td>
                                </tr>
                                
                            </table>
                            
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
