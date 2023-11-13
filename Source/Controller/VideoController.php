<?php
include 'BaseController.php';
class VideoController extends BaseController{
    private $DB, $videoModel, $user;
    
    public function __construct() {
        $this->DB = $this->model("DataBase");
        $this->videoModel = $this->model("VideoModel");
        require('Models/User.php');
        $username = $_COOKIE["username"];
        $sql = "SELECT * FROM user WHERE username = '$username'"; 
        $user = $this->DB->query($sql);
        $r = $user->fetch_assoc();
        $fullname = $r["fullname"];
        $avt = $r["img"];
        $this->user = new User($fullname, $username, $avt);
    }

    public function watch($id)
    {
        // Lấy và nạp dữ liệu
        $id_video = $id;
        $sql = "SELECT v.*, u.fullname, u.img FROM video v, user u WHERE v.username = u.username and v.id_video = $id_video";
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
                $data[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"], "uname"=>$r["username"]];
            }
        }
        // tải các video để xem sau
        $data_videos = $this->videoModel->loadListVideo($id);

        // tải các comment của video
        $data_comments = $this->videoModel->loadComment($id);

        $content = array('data'=>$data, 'data_videos'=>$data_videos, 'data_comments'=>$data_comments, 'username'=>$this->user->username, 'fullname'=>$this->user->fullname, 'avt'=>$this->user->avt);
        return $this->view("Video/Watch.php", $content);
    }
}
?>