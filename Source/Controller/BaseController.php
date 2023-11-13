<?php    
    class BaseController{
        public function view($url,array $data = []){
            // Đặt từng key trong mảng data thành tên biến với giá trị là $value
            foreach($data as $key => $value){
                $$key = $value;
            }

            $url = 'Views'.DIRECTORY_SEPARATOR.$url;
            require ($url);
        }

        // Khởi tạo model
        public function model($nameModel)
        {
            require('Models/'.$nameModel.'.php');
            return new $nameModel;
        }

        // Kiểm tra user đã đăng nhập chưa
        public function checkLogin()
        {
            return (isset($_COOKIE["username"]))?true:false;
        }
    }
?>