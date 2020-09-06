<?php include "inc/header.php";?>
<?php include 'inc/left-sidebar.php';?>
<?php include '../classes/catagory.php';?>


      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class="mb-0 alert alert-info"><strong>All Catagory</strong></h1>
          <?php 
            $cat = new catagory();
            if(isset($_GET['delid'])){
            $gatCatId = base64_decode($_GET['delid']);
            $delcatsuccess = $cat->delcatagory($gatCatId);
            }
            if(isset($delcatsuccess)){
                  echo $delcatsuccess;
              }
          ?>
          <div class="d-flex">
          <table class="m-2 table table-hover table-bordered table-striped w-98">
            <thead class='w-100'>
                <tr class='w-100'>
                    <th>No</th>
                    <th>Catagory Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $sowcat = new catagory();
              $getcat = $sowcat->showCatagory();
              $i = 0;
              if($getcat){
                while($result = $getcat->fetch_assoc()){
                  $i++;
            ?>
              <tr>
                <td><?=$i?></td>
                <td><?=ucwords($result['catagoryName']);?></td>
                <td>
                  <span>
                    <a href="editeCat.php?id=<?=base64_encode($result['id']);?>">Edite</a> ||
                    <a onclick="return confirm('Are You Sure To Delete')" href="?delid=<?=base64_encode($result['id']);?>">Delete</a>
                  </span>
                </td>
              </tr>
                <?php } }?>
            </tbody>
          </table>
          </div>
          <div class="m-2">
          <a href="addcatagory.php" class="btn btn-info">Add Catagory</a>
          </div>
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>