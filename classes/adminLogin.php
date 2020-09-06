
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/session.php');
    Session::checkLogin();
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../halpers/formet.php');
?>
<?php 
// admin login class 
class adminlogin{
    private $db;
    private $fm;
    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function adminlogin($username, $password){
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $password = md5($password);

        if(empty($username) || empty($password)){
            $loginmsg = 'Fild Must Not Be empty';
            return $loginmsg;
        }else{
            $query = "SELECT * FROM tbl_users WHERE username = '$username' AND loginPassword = '$password'";
            $result = $this->db->select($query);
            if($result != false){
                $val = $result->fetch_assoc();
                session::set('adminlogin', true);
                session::set('id', $val['id']);
                session::set('username', $val['username']);
                session::set('name', $val['name']);
                session::set('email', $val['email']);
                header("Location:dashboard.php");
            }else{
                $loginmsg = 'Username And Password Not Metch';
                return $loginmsg;
            }
        }
        
    }
}

?>