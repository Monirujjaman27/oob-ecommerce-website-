
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../halpers/formet.php');
?>
<?php
    class Product{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert($data, $file){
            
            $title        = $this->fm->validation($data['title']);
            $catId        = $this->fm->validation($data['catId']);
            $brandId      = $this->fm->validation($data['brandId']);
            $body         = $this->fm->validation($data['body']);
            $price        = $this->fm->validation($data['price']);
            $discount     = $this->fm->validation($data['discount']);
            $type         = $this->fm->validation($data['type']);
            $availability = $this->fm->validation($data['availability']);

            $title        = mysqli_real_escape_string($this->db->link, $title);
            $catId        = mysqli_real_escape_string($this->db->link, $catId);
            $brandId      = mysqli_real_escape_string($this->db->link, $brandId);
            $body         = mysqli_real_escape_string($this->db->link, $body);
            $price        = mysqli_real_escape_string($this->db->link, $price);
            $discount     = mysqli_real_escape_string($this->db->link, $discount);
            $type         = mysqli_real_escape_string($this->db->link, $type);
            $availability = mysqli_real_escape_string($this->db->link, $availability);         
            
            $permited  = array('jpg', 'jepg', 'png', 'gif'); 
            $file_name = $file['thumbnail']['name'];
            $file_size = $file['thumbnail']['size'];
            $file_temp = $file['thumbnail']['tmp_name'];

            $div          = explode('.', $file_name);
            $file_ext     = strtolower(end($div));
            $unique_image = date('d-m-y').'-'.time().'.'.$file_ext;
            $upload_image = "upload/".$unique_image;
            if($title == '' || $catId == '' || $brandId == '' || $file_name == '' || $body == '' || $price == '' || $type == ''|| $discount == '' || $availability == ''){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }elseif($file_size>1048567){
                $msg = "Image size Should be less then 1MB";
                return $msg;
            }elseif(in_array($file_ext, $permited) === FALSE){
                $msg = "You can upload only: ".implode(', ' , $permited);  
                return $msg;
            }else{
                move_uploaded_file($file_temp, $upload_image);
                $query = "INSERT INTO tbl_product(title, catId, brandId, thumbnail, body, price, discount, type, availability) VALUES ('$title','$catId','$brandId','$unique_image','$body','$price','$discount','$type','$availability')";
                $result = $this->db->insert($query);
                if($result){
                    $msg = "<p class='mb-0 alert alert-success'>Insert Success</p>";
                    return $msg;
                }else{
                    $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Insert the Catagory</p>';
                    return $msg;
                }
            }
        }

        public function show(){
            $query = "SELECT tbl_product.*, tbl_catagory.catagoryName, tbl_brand.brandName 
            FROM tbl_product
            INNER JOIN tbl_catagory
            ON tbl_product.catId = tbl_catagory.id
            INNER JOIN tbl_brand
            ON tbl_product.brandId = tbl_brand.id
            order by tbl_product.id DESC";

            $result = $this->db->select($query);
            return $result;
        }
        public function update($data, $file, $gatId){
            
            $title        = $this->fm->validation($data['title']);
            $catId        = $this->fm->validation($data['catId']);
            $brandId      = $this->fm->validation($data['brandId']);
            $body         = $this->fm->validation($data['body']);
            $price        = $this->fm->validation($data['price']);
            $discount     = $this->fm->validation($data['discount']);
            $type         = $this->fm->validation($data['type']);
            $availability = $this->fm->validation($data['availability']);
        
            $title        = mysqli_real_escape_string($this->db->link, $title);
            $catId        = mysqli_real_escape_string($this->db->link, $catId);
            $brandId      = mysqli_real_escape_string($this->db->link, $brandId);
            $body         = mysqli_real_escape_string($this->db->link, $body);
            $price        = mysqli_real_escape_string($this->db->link, $price);
            $discount     = mysqli_real_escape_string($this->db->link, $discount);
            $type         = mysqli_real_escape_string($this->db->link, $type);
            $availability = mysqli_real_escape_string($this->db->link, $availability);


            $permited  = array('jpg', 'jepg', 'png', 'gif'); 
            $file_name = $file['thumbnail']['name'];
            $file_size = $file['thumbnail']['size'];
            $file_temp = $file['thumbnail']['tmp_name'];

            $div          = explode('.', $file_name);
            $file_ext     = strtolower(end($div));
            $unique_image = date('d-m-y').'-'.time().'.'.$file_ext;
            $upload_image = "upload/".$unique_image;


        if(empty($file_name)){
            if($title == '' || $catId == '' || $brandId == '' || $body == '' || $price == '' || $type == '' || $discount == '' || $availability == ''){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                    $query = "UPDATE tbl_product SET title = '$title', catId = '$catId', brandId = '$brandId', body = '$body', price = '$price', discount = '$discount', type = '$type', availability = '$availability' WHERE id = '$gatId'";
                    $result = $this->db->update($query);
                    if($result){
                        $msg = "<p class='mb-0 alert alert-success'>Update Success</p>";
                        return $msg;
                    }else{
                        $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Update the Catagory</p>';
                        return $msg;
                    }
                }
            }else{

                if($title == '' || $catId == '' || $brandId == '' || $file_name == '' || $body == '' || $price == '' || $type == '' || $discount == '' || $availability == ''){
                    $msg = 'Fild Must Not Be empty';
                    return $msg;
                }else{
                    if($file_size>1048567){
                    $msg = "Image size Should be less then 1MB";
                    return $msg;
                    }elseif(in_array($file_ext, $permited) === FALSE){
                        $msg = "You can upload only: ".implode(', ' , $permited);  
                        return $msg;
                    }else{
                        move_uploaded_file($file_temp, $upload_image);
                        $query = "UPDATE tbl_product SET title = '$title', catId = '$catId', brandId = '$brandId', thumbnail = '$unique_image', body = '$body', price = '$price', discount = '$discount', type = '$type', availability = '$availability' WHERE id = '$gatId'";
                        $result = $this->db->update($query);
                        if($result){
                            $msg = "<p class='mb-0 alert alert-success'>Update Success</p>";
                            return $msg;
                        }else{
                            $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Update the Catagory</p>';
                            return $msg;
                        }
                    }
                 }

            }            
        }


        public function delete($gatId){
              $delquery = "DELETE FROM tbl_product WHERE id = '$gatId'";
              $del = $this->db->delete($delquery);
              if($del){
                $msg = "<p class='mb-0 alert alert-success'>Delete Success</p>";
                return $msg;
            }else{
                $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Delete</p>';
                return $msg;
            }
        }
        public function showByGatId($gatId){
            $query = "SELECT * FROM tbl_Product WHERE id = '$gatId'";
            $result = $this->db->select($query);
            return $result;
        }


        public function getProForFeatured(){
            $query = "SELECT * FROM tbl_Product WHERE type = '1' order by id desc";    
            $result = $this->db->select($query);
            return $result;        
        }

        public function getProForNew(){
            $query = "SELECT * FROM tbl_Product  order by id desc";    
            $result = $this->db->select($query);
            return $result;        
        }
        public function proByCatagory($gatcatId){
            $gatcatId = mysqli_real_escape_string($this->db->link, $gatcatId);
            $query = "SELECT * FROM tbl_product WHERE catId = '$gatcatId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertwisInfo($cmrId, $productId){
            $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
            $result = $this->db->select($squery);
            if($result){
                while($orderData = $result->fetch_assoc()){

                    $productId   = $orderData['productId'];
                    $productName = $orderData['productName'];
                    $image       = $orderData['thumbnail'];
                    $price       = $orderData['price'];
                    $quantity    = $orderData['quantity'];

                    $query = "INSERT INTO tbl_wishlist (productId, sId, cmrId, ProductName, image, price, quantity) VALUE('$productId', '$cmrId', '$productName', '$image', '$price', '$quantity')";
                    $orderinsertr = $this->db->insert($query);
                    
                }

            }

        }





        public function getwishlist($gatId, $cmrId){
            $gatId = mysqli_real_escape_string($this->db->link, $gatId);
            $sId = session_id();

            $ckquery = "SELECT * FROM tbl_wishlist WHERE productId = '$gatId' AND cmrId = '$cmrId'";
            $result = $this->db->select($ckquery);
            if($result){
                // echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
                // echo "<script>window.location='index.php';</script>";
                    $msg = '<span class="warning">Already Added Please visite <a href="product-comperison.php"> Wishlist paage</a> </span>';
                return $msg;
            }else{

                $query = "SELECT * FROM tbl_product WHERE id = '$gatId'";

                $result = $this->db->select($query);
                $data = $result->fetch_assoc();

                $productId = $data['id'];
                $productName = $data['title'];
                $price = $data['price'];
                $image = $data['thumbnail'];
                $quantity = 1;

                $query = "INSERT INTO tbl_wishlist(cmrId, productId, productName, price, quantity, image) VALUES ('$cmrId','$productId ','$productName','$price','$quantity','$image')";
                $inserted = $this->db->insert($query);
                    if($inserted){
                        $msg = '<span class="mb-0 text-success success bg-info">Wishlist insertd <a href="wishlist.php.php">Got to Wishlist paage</a> </span>';
                        return $msg;
                    }
            }
        }
        

        public function selectwishlist($cmrId){
            $query = "SELECT * FROM tbl_wishlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function delwishdata($pId,$cmrId){
            $delquery = "DELETE FROM tbl_wishlist WHERE cmrId = '$cmrId' AND productId = '$pId'";
            $delresult = $this->db->delete($delquery);
        }




        public function getCompire($gatId){
            $gatId = mysqli_real_escape_string($this->db->link, $gatId);
            $sId = session_id();

            $ckquery = "SELECT * FROM tbl_compare WHERE productId = '$gatId' AND sId = '$sId'";
            $result = $this->db->select($ckquery);
            if($result){
                // echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
                // echo "<script>window.location='index.php';</script>";
                    $msg = '<span class="warning bg-info">Already Added Please visite <a href="product-comperison.php">Compire Page</a> </span>';
                return $msg;
            }else{

                $query = "SELECT * FROM tbl_product WHERE id = '$gatId'";

                $result = $this->db->select($query);
                $data = $result->fetch_assoc();
                $sId = session_id();
                $productId    = $data['id'];
                $productName  = $data['title'];
                $price        = $data['price'];
                $image        = $data['thumbnail'];
                $description  = $data['body'];
                $discount     = $data['discount'];
                $availability = $data['availability'];

                $query = "INSERT INTO tbl_compare(sId, productId, productName, price, image, discount, description, availability) VALUES ('$sId','$productId ','$productName','$price','$image','$discount','$description','$availability')";
                $inserted = $this->db->insert($query);
                    if($inserted){
                        $msg = '<span class="mb-0 text-success success bg-info">Compire insertd<a href="product-comperison.php">Got to Compire</a> </span>';
                        return $msg;
                    }
            }
        }
        



        public function checkCmprTbl(){
            $sId = session_id();
            $query = "SELECT* FROM tbl_compare WHERE sId = '$sId'  ORDER BY id DESC limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function deleteCmprData($gatId){
            $sId = session_id();
            $delcmprquery = "DELETE FROM tbl_compare WHERE id = '$gatId' AND sId  = '$sId'";
            $delresult = $this->db->delete($delcmprquery);

        }
        public function emptyCmprData(){
            $sId = session_id();
            $delcmprquery = "DELETE FROM tbl_compare WHERE sId  = '$sId'";
            $delresult = $this->db->delete($delcmprquery);

        }

        public function addcartfrmCompire($gatId){
            $gatId = mysqli_real_escape_string($this->db->link, $gatId);
            $sId = session_id();
            $ckquery = "SELECT * FROM tbl_cart WHERE productId = '$gatId' AND sId = '$sId'";
            $result = $this->db->select($ckquery);
            if($result){
                // echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
                   // echo "<script>window.location='product-comparison.php';</script>";
                    $msg = '<span class="warning bg-info">Already Added</span>';
                    
                return $msg;
            }else{
                $query = "SELECT * FROM tbl_product WHERE id = '$gatId'";

                $result = $this->db->select($query);
                $data = $result->fetch_assoc();

                $productId = $data['id'];
                $productName = $data['title'];
                $price = $data['price'];
                $image = $data['thumbnail'];
                $quantity = 1;

                $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUES ('$sId','$productId ','$productName','$price','$quantity','$image')";
                $inserted = $this->db->insert($query);
                if($inserted){
                    $sId = session_id();
                    $delquery = "DELETE FROM tbl_compare WHERE sId = '$sId' AND productId = '$gatId'";
                    $delresult = $this->db->delete($delquery);
                    echo "<script>window.location='product-comparison.php';</script>";
                }
            }
            
        }

        public function addcartfrmWish($gatId, $cmrId ){
            $gatId = mysqli_real_escape_string($this->db->link, $gatId);
            $ckquery = "SELECT * FROM tbl_cart WHERE productId = '$gatId' AND cmrId = '$cmrId'";
            $result = $this->db->select($ckquery);
            if($result){
                // echo "<meta http-equiv='refresh' content='0;URL=?id=load'/>";
                // echo "<script>window.location='index.php';</script>";
                    $msg = '<span class="warning bg-info">Already Added</span>';
                return $msg;
            }else{
                $query = "SELECT * FROM tbl_product WHERE id = '$gatId'";

                $result = $this->db->select($query);
                $data = $result->fetch_assoc();

                $sId = session_id();
                $productId = $data['id'];
                $productName = $data['title'];
                $price = $data['price'];
                $image = $data['thumbnail'];
                $quantity = 1;

                $query = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUES ('$sId','$productId ','$productName','$price','$quantity','$image')";
                $inserted = $this->db->insert($query);
                if($inserted){
                    $delquery = "DELETE FROM tbl_wishlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
                    $delresult = $this->db->delete($delquery);
                }
            
            }
        }









    }
?>