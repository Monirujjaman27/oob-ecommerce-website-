<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../halpers/formet.php');
 ?>


<?php 
    class catagory{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function addcatagory($catagory){
            $catagory = $this->fm->validation($catagory);
            $catagory = mysqli_real_escape_string($this->db->link, $catagory);
            
            if(empty($catagory)){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                $query = "INSERT INTO tbl_catagory (catagoryName) VALUES ('$catagory')";
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
        public function showCatagory(){
            $query = "SELECT * FROM tbl_catagory order by id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function updatecatagory($editecat, $gatCatId){
            $editecat = $this->fm->validation($editecat);
            $editecat = mysqli_real_escape_string($this->db->link, $editecat);
            $gatCatId = mysqli_real_escape_string($this->db->link, $gatCatId);
            if(empty($editecat)){
                $msg = 'Fild Must Not Be empty';
                return $msg;
            }else{
                $query = "UPDATE tbl_catagory SET catagoryName = '$editecat' WHERE id = '$gatCatId'";
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
        public function delcatagory($gatCatId){
              $delquery = "DELETE FROM tbl_catagory WHERE id = '$gatCatId'";
              $delcat = $this->db->delete($delquery);
              if($delcat){
                $msg = "<p class='mb-0 alert alert-success'>Delete Success</p>";
                return $msg;
            }else{
                $msg = '<p class="mb-0 text-warning">There Was Something Wrong to Delete the Catagory</p>';
                return $msg;
            }
        }
        public function showvalcalt($gatCatId){
            $query = "SELECT * FROM tbl_catagory WHERE id = '$gatCatId'";
            $result = $this->db->select($query);
            return $result;
        }

    }
?>