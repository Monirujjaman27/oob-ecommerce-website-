
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../halpers/formet.php');
?>
<?php
    class Customer{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert($data){
            $uname    = $this->fm->validation($data['uname']);
            $email    = $this->fm->validation($data['email']);
            $pass     = $this->fm->validation(md5($data['pass']));
            $country  = $this->fm->validation(ucwords($data['country']));
            $city     = $this->fm->validation(ucwords($data['city']));
            $phone    = $this->fm->validation($data['phone']);
            $zipCode  = $this->fm->validation($data['zipCode']);

            $uname   = mysqli_real_escape_string($this->db->link, $uname);
            $email   = mysqli_real_escape_string($this->db->link, $email);
            $pass    = mysqli_real_escape_string($this->db->link, $pass);
            $country = mysqli_real_escape_string($this->db->link, $country);
            $city    = mysqli_real_escape_string($this->db->link, $city);
            $phone   = mysqli_real_escape_string($this->db->link, $phone);
            $zipCode = mysqli_real_escape_string($this->db->link, $zipCode);

            if($uname == '' || $email == '' || $pass == '' || $country == '' || $city == '' || $phone == '' || $zipCode == ''){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                $userQuery = "SELECT * FROM tbl_cuser WHERE uname = '$uname' LIMIT 1";
                $userCk    = $this->db->select($userQuery); 
                $mailQuery = "SELECT * FROM tbl_cuser WHERE email = '$email' LIMIT 1";
                $mailCk    = $this->db->select($mailQuery); 
                if ($userCk != FALSE){
                    $msg  = "Username already exists";
                    return $msg;
                }elseif($mailCk){
                    $msg  = "Email already exists";
                    return $msg;
                }else{
                $query = "INSERT INTO tbl_cuser(uname, email, pass, country, city, phone, zipCode) VALUES ('$uname','$email','$pass','$country','$city','$phone','$zipCode')";
               
                $result = $this->db->insert($query);
                if($result){
                    $msg = "<p class='mb-0 alert alert-success'>Account Create Success</p>";
                    return $msg;
                }else{
                    $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Insert the Catagory</p>';
                    return $msg;
                }
                }
            }


        }



        public function cmrlogin($data){
            
            $email  = $this->fm->validation($data['lemail']);
            $pass   = $this->fm->validation(md5($data['lpass']));

            $email   = mysqli_real_escape_string($this->db->link, $email);
            $pass    = mysqli_real_escape_string($this->db->link, $pass);

            if(empty($email) || empty($pass)){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }

            $mailQuery = "SELECT * FROM tbl_cuser WHERE email = '$email' LIMIT 1";
            $mailCk    = $this->db->select($mailQuery); 
            
            $passQuery = "SELECT * FROM tbl_cuser WHERE pass = '$pass' LIMIT 1";
            $passCk    = $this->db->select($passQuery); 

               if($mailCk == FALSE){
                    $msg = 'Email dose not exists';
                    return $msg;
               }elseif($passCk == FALSE){
                    $msg = 'Wrong Password';
                    return $msg;
               }else{
                $query = "SELECT * FROM tbl_cuser WHERE email = '$email' AND pass = '$pass'";
                $result = $this->db->select($query);
                if($result != FALSE){

                    $val = $result->fetch_assoc();
                    Session::set("cmrLogin", true);
                    Session::set('cmrId', $val['id']);
                    Session::set('cmrUname', $val['uname']);
                    Session::set('cmrimage', $val['image']);
                    
                    echo "<script>window.location='shopping-cart.php';</script>";
                    
                }
               }


        }
        public function select($cmrId){
            $squery = "SELECT * FROM tbl_cuser WHERE id = '$cmrId'";
            $result = $this->db->select($squery);
            return $result;
            
        }
        public function updateProPic($file, $cmrId){
            $permited  = array('jpg', 'jepg', 'png', 'gif'); 
            $file_name = $file['addproPic']['name'];
            $file_size = $file['addproPic']['size'];
            $file_temp = $file['addproPic']['tmp_name'];

            $div          = explode('.', $file_name);
            $file_ext     = strtolower(end($div));
            $unique_image = date('d-m-y').'-'.time().'.'.$file_ext;
            $upload_image = "Admin/upload/profile/".$unique_image;



            if(!empty($file_name)){
                if($file_size>1048567){
                $msg = "Image size Should be less then 1MB";
                return $msg;
                }elseif(in_array($file_ext, $permited) === FALSE){
                    $msg = "You can upload only: ".implode(', ' , $permited);  
                    return $msg;
                }else{
                    move_uploaded_file($file_temp, $upload_image);
                    $query = "UPDATE tbl_cuser SET  image = '$unique_image' WHERE id = '$cmrId'";
                    $result = $this->db->update($query);
                    if($result){
                        $msg = "<p class='mb-0 alert alert-success' style='font-size:25px;'>Profile Picture Update Success</p>";
                        return $msg;
                    }else{
                        $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Update the Catagory</p>';
                        return $msg;
                    }
                }
             }
        }
        
        public function infoUpdate($data, $cmrId){
            $uname      = $this->fm->validation($data['uname']);
            $email      = $this->fm->validation($data['email']);
            $country    = $this->fm->validation(ucwords($data['country']));
            $city       = $this->fm->validation(ucwords($data['city']));
            $phone      = $this->fm->validation($data['phone']);
            $zipCode    = $this->fm->validation($data['zipCode']);

            $uname      = mysqli_real_escape_string($this->db->link, $uname);
            $email      = mysqli_real_escape_string($this->db->link, $email);
            $country    = mysqli_real_escape_string($this->db->link, $country);
            $city       = mysqli_real_escape_string($this->db->link, $city);
            $phone      = mysqli_real_escape_string($this->db->link, $phone);
            $zipCode    = mysqli_real_escape_string($this->db->link, $zipCode);

            if($uname == '' || $email == '' || $country == '' || $city == '' || $phone == '' || $zipCode == ''){
                $msg  = " <p class='mb-0 alert alert-warning' style='font-size:25px; color:red;'>Fild must not empty</p> ";
                return $msg;
            }else{
                    $query = "UPDATE tbl_cuser SET uname = '$uname', email = '$email', country = '$country', city = '$city', zipCode = '$zipCode' WHERE id = '$cmrId'";
                
                    $result = $this->db->update($query);
                    if($result){
                        $msg = "<p class='mb-0 alert alert-success' style='font-size:25px;'> Info Update Success</p>";
                        return $msg;
                    }else{
                        $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Update Your Profile Info</p>';
                        return $msg;
                    }           
                
                }
            
        }




        public function insertOrderInfo($cmrId){
            $sId = session_id();
            $squery = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($squery);
            if($result){
                while($orderData = $result->fetch_assoc()){

                    $productId   = $orderData['productId'];
                    $productName = $orderData['productName'];
                    $image       = $orderData['image'];
                    $price       = $orderData['price'];
                    $quantity    = $orderData['quantity'];

                    $query = "INSERT INTO tbl_order (productId, sId, cmrId, ProductName, image, price, quantity) VALUE('$productId', '$sId', '$cmrId', '$productName', '$image', '$price', '$quantity')";
                    $orderinsertr = $this->db->insert($query);
                }

            }

        }
        public function getOrderData($cmrId){
            $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' AND dateTime = now() ";
            $result = $this->db->select($query);
            return $result;
        }
        public function getOrderdetails($cmrId){
            $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' order by dateTime desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function checkorderTbl(){
            $query = "SELECT * FROM tbl_order order by dateTime desc";
            $result = $this->db->select($query);
            return $result;
        }
        public function checkNewOrderTbl($cmrId){
            $query = "SELECT * FROM tbl_cuser WHERE id = '$cmrId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateStatus($gatId){
            $query = "UPDATE tbl_order SET status = '1', NA = '2'  WHERE id = '$gatId' AND status = '0'";
            $result = $this->db->update($query);
            return $result;
        }
        public function updateNA($gatId){
            $query = "UPDATE tbl_order SET status = '0', NA = '1'  WHERE id = '$gatId' AND NA = '0' ";
            $result = $this->db->update($query);
            return $result;
        }
        public function delorderData($gatId, $cmrId){
            $query = "DELETE FROM tbl_order WHERE id = '$gatId' AND cmrId = '$cmrId' ";
            $result = $this->db->delete($query);
            return $result;
        }










    }
    ?>