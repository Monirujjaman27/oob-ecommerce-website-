<?php include "inc/header.php";?>

<?php include 'inc/left-sidebar.php';?>
      <div class="col-sm-8 ">
      <div class="card border-dark mh-600">
          <h1 class=" alert alert-info"><strong>All Posts</strong></h1>
          <div class="d-flex">
          <table class="m-2 table table-hover table-bordered table-striped w-98">
            <thead class='w-100'>
                <tr class='w-100'>
                    <th>No</th>
                    <th>Title</th>
                    <th>Body </th>
                    <th>Thumbnail </th>
                    <th>Date </th>
                    <th>Author </th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>first post</td>
                <td>this is first post title</td>
                <td>1-2-2020</td>
                <td>1-2-2020</td>
                <td>moner</td>
                <td><span><a href="#">Edite</a> || <a href="#">Delete</a></span></td>
              </tr>
            </tbody>
          </table>
          </div>
          <div class="m-2">
          <a href="#" class="btn btn-info">Add New Post</a>
          </div>
        </div>
      </div>
      <?php include "inc/right-sidebar.php";?>
<!-- footer -->

<?php include 'inc/footer.php';?>