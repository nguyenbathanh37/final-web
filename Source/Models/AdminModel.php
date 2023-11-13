<?php
class AdminModel{
        private $DB;

        public function __construct() {
            $this->DB = new DataBase();
        }

        // Tải những video đã được chọn làm feature
        public function getAllVideoFeature(){
            $query = "SELECT `id_video` FROM `feature`";
            $result_feature = $this->DB->query($query);
            
            return $result_feature->fetch_all();
        }

        // Tải những video đã bị vi phạm
        public function getVideoViPham()
        {
            $vipham = array();
            $query = "SELECT `id_video` FROM `vipham`";
            $result_vipham = $this->DB->query($query);
            // $res = $conn->query("select * from product");
            return $result_vipham->fetch_all();
        }

        // Tải tất cả video
        public function getAllVideo()
        {
            $query = "SELECT * FROM `video`";
            $result = $this->DB->query($query);
            return $result->fetch_all();
        }
    }
?>