<?php
    class UserModel{
        private $DB;

        public function __construct() {
            // Kết nối database
            $this->DB = new DataBase();
        }

        // tải những tài khoản đã đăng kí tài khoản user
        public function getUserSubscribed()
        {
            $username = $_COOKIE["username"];
            $sql = "SELECT u.* FROM subscribe s, user u WHERE s.username = '$username' and s.registered_account = u.username";
            $result = $this->DB->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $account = $r["username"];
                    $sub = $this->DB->query("SELECT * FROM subscribe s WHERE s.registered_account = '$account'");
                    $num_sub = $sub->num_rows;
                    $sub_format = '';
                    while($num_sub > 1000){
                        $remain = $num_sub%1000;
                        $num_sub = (int)($num_sub/1000);
                        $sub_format = ','.$remain.$sub_format;
                    }
                    $sub_format = $num_sub.$sub_format;
                    $data[] = ["username"=>$r["username"], "fullname"=>$r["fullname"], "num_sub"=>$sub_format, "avt"=>$r["img"]];
                }
            }
            return $data;
        }
    }
?>