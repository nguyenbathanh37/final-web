<?php    
    class VideoModel{
        private $DB;

        public function __construct() {
            // Kết nối database
            $this->DB = new DataBase();
        }

        // Tải tất cả video(video không bị vi phạm)
        public function getAllVideo(){
            $username = $_COOKIE["username"];
            $sql = "SELECT * FROM video WHERE username = '$username' and id_video not in (SELECT id_video FROM vipham)";
            try{
                $result = $this->DB->query($sql);
                $data = array();
                if($result->num_rows > 0){
                    while($r = $result->fetch_assoc()){
                        $data[] = array("id"=>$r["id"], "name"=>$r["name"], "date"=>$r["date"], "mode"=>$r["mode"], "video"=>$r["video"]);
                    }
                }
                echo json_encode(array('status'=>true, 'data'=>"Thành công"));
            }catch(PDOException $e){
                die(json_encode(array('status'=>false, 'data'=>$e->getMessage())));
            }
        }

        // Tải tất cả video của user
        public function getAllVideoOfUser($username, $start, $num){
            $sql = "SELECT * FROM video WHERE username = '$username' and mode = 0 and id_video not in (SELECT id_video FROM vipham) LIMIT ". $start . "," . $num;
            $result = $this->DB->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $data[] = array("id"=>$r["id"], "name"=>$r["name"], "date"=>$r["date"], "mode"=>$r["mode"], "video"=>$r["video"]);
                }
            }

            return $data;
        }

        // Tải những video được chọn làm feature(những video này không bị vi phạm)
        public function getVideoFeature($start, $num){
            $username = $_COOKIE["username"];

            $sql = "SELECT v.*, u.fullname, u.img FROM feature f, video v, user u WHERE f.id_video = v.id_video and v.username = u.username and v.mode = 0 and v.id_video not in (SELECT id_video FROM vipham) LIMIT ". $start . "," . $num;
            $result = $this->DB->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $view = (int)$r["view"];
                    $view_format = '';
                    while($view > 1000){
                        $remain = $view%1000;
                        $view = (int)($view/1000);
                        $view_format = ','.$remain.$view_format;
                    }
                    $view_format = $view.$view_format;
                    $data[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"]];
                }
            }
            return $data;
        }

        // Tải những video user đã like
        public function getVideoLiked($start, $num){
            $username = $_COOKIE["username"];
            $sql = "SELECT v.*, u.fullname, u.img FROM liked l, video v, user u WHERE l.id_video = v.id_video and l.username = '$username' and v.username = u.username and v.id_video not in (SELECT id_video FROM vipham) LIMIT ". $start . "," . $num;
            $result = $this->DB->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $view = (int)$r["view"];
                    $view_format = '';
                    while($view > 1000){
                        $remain = $view%1000;
                        $view = (int)($view/1000);
                        $view_format = ','.$remain.$view_format;
                    }
                    $view_format = $view.$view_format;
                    $data[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"]];
                }
            }
            return $data;
        }

        // Tải lịch sử của user
        public function getHistory($start, $num)
        {
            $username = $_COOKIE["username"];
            $sql = "SELECT v.*, u.fullname, u.img, h.date_watch FROM history h, video v, user u WHERE h.id_video = v.id_video and h.username = '$username' and v.username = u.username and v.id_video not in (SELECT id_video FROM vipham) ORDER BY h.date_watch DESC LIMIT ". $start . "," . $num;
            $result = $this->DB->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $view = (int)$r["view"];
                    $view_format = '';
                    while($view > 1000){
                        $remain = $view%1000;
                        $view = (int)($view/1000);
                        $view_format = ','.$remain.$view_format;
                    }
                    $view_format = $view.$view_format;
                    $data[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"]];
                }
            }
            return $data;
        }

        // Tải video để xem
        public function loadListVideo($id)
        {
            $id_video = $id;
            $sql = "SELECT v.*, u.fullname, u.img FROM video v, user u WHERE v.username = u.username and v.id_video != $id_video limit 10";
            $result = $this->DB->query($sql);
            $data_videos = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $view = (int)$r["view"];
                    $view_format = '';
                    while($view > 1000){
                        $remain = $view%1000;
                        $view = (int)($view/1000);
                        $view_format = ','.$remain.$view_format;
                    }
                    $view_format = $view.$view_format;
                    $data_videos[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"]];
                }
            }
            return $data_videos;
        }

        // Tải comment của video có id = $id
        public function loadComment($id)
        {
            $sql = "SELECT c.*, u.fullname, u.img FROM comment c, user u WHERE c.username = u.username and c.id_video = $id";
            $result = $this->DB->query($sql);
            $data_comments = array();
            if($result->num_rows > 0){
                while($r = $result->fetch_assoc()){
                    $data_comments[] = ["id_video"=>$r["id_video"], "content"=>$r["content"], "fullname"=>$r["fullname"], "avt"=>$r["img"]];
                }
            }
            
            return $data_comments;
        }
    }
?>