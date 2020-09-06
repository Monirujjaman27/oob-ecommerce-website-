<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../halpers/formet.php');
?>
<?php
    class brand{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function addbrand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            
            if(empty($brandName)){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                $query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
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
            $query = "SELECT * FROM tbl_brand order by id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function updatebrand($editeBrand, $gatBndId){
            $editeBrand = $this->fm->validation($editeBrand);
            $editeBrand = mysqli_real_escape_string($this->db->link, $editeBrand);
            if(empty($editeBrand)){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$editeBrand' WHERE id = '$gatBndId'";
                $result = $this->db->update($query);
                if($result){
                    $msg = "<p class='mb-0 alert alert-success'>Update Success</p>";
                    return $msg;
                }else{
                    $msg = '<p class="mb-0 text-warning">There Was Something Wrong to update the Catagory</p>';
                    return $msg;
                }
            }

        }
        public function delBrand($gatId){
              $delquery = "DELETE FROM tbl_brand WHERE id = '$gatId'";
              $delBrand = $this->db->delete($delquery);
              if($delBrand){
                $msg = "<p class='mb-0 alert alert-success'>Delete Success</p>";
                return $msg;
            }else{
                $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Delete the Catagory</p>';
                return $msg;
            }
        }
        public function showvalBrand($gatId){
            $query = "SELECT * FROM tbl_brand WHERE id = '$gatId'";
            $result = $this->db->select($query);
            return $result;
        }

    }
?>