<?php
    class User{
        public $fullname;
        public $username;
        public $avt;

        // Khởi tạo user
        public function __construct($fname, $uname, $avt) {
            $this->fullname = $fname;
            $this->username = $uname;
            $this->avt = $avt;
        }
    }
?>