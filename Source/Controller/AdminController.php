<?php
include 'BaseController.php';

class AdminController extends BaseController{
    private $DB, $admin, $videoModel;
    public function __construct() {
        $this->DB = $this->model("DataBase");
        $this->admin = $this->model("AdminModel");
        $this->videoModel = $this->model("VideoModel");
    }

    public function index()
    {
        $result_feature = $this->admin->getAllVideoFeature();
        $feature = array();
        foreach ($result_feature as $value) {
            array_push($feature, $value[0]);
        }

        $result_vipham = $this->admin->getVideoViPham();
        $vipham = array();
        foreach ($result_vipham as $value) {
            array_push($vipham, $value[0]);
        }

        $result = $this->admin->getAllVideo();
        $content = array('feature'=>$feature, 'vipham'=>$vipham, 'result'=>$result);
        return $this->view("admin/pageMain.php", $content);
    }

    public function modify()
    {
        if(isset($_POST['save_'])){

            $id = (int)$_POST['id_video'];
            $trangthai = $_POST['save_'];
            if($trangthai == "1"){
                $query = "INSERT INTO `feature` (`id_video`) VALUES ('$id');";
                $result = $this->DB->query($query);
        
            }elseif($trangthai == "0"){
                $query = "INSERT INTO `vipham` (`id_video`) VALUES ('$id');";
                $result = $this->DB->query($query);
            }
        }
        elseif(isset($_POST['delete_'])){
            $id = (int)$_POST['id_video'];
            $trangthai = $_POST['delete_'];
            if($trangthai == "1"){
                $query = "DELETE FROM `feature` Where `id_video` = '$id';";
                $result = $this->DB->query($query);
        
            }elseif($trangthai == "0"){
                $query = "DELETE FROM `vipham` Where `id_video` = '$id';";
                $result = $this->DB->query($query);
            }
        }
        return $this->view("admin/pageMain.php");
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

        $content = array('data'=>$data, 'data_videos'=>$data_videos, 'data_comments'=>$data_comments, 'username'=>"Admin", 'fullname'=>"Admin", 'avt'=>"assets/images/admin.png");
        return $this->view("Video/Watch.php", $content);
    }

    public function process_save()
    {
        if(isset($_POST['ok'])){
            if(isset($_POST['save_'])){
        
                $id = (int)$_POST['id_video'];
                $trangthai = $_POST['save_'];
                if($trangthai == "1"){
                    $query = "INSERT INTO `feature` (`id_video`) VALUES ('$id');";
                    $result = $this->DB->query($query);
            
                }elseif($trangthai == "0"){
                    $query = "INSERT INTO `vipham` (`id_video`) VALUES ('$id');";
                    $result = $this->DB->query($query);
                }
            }
            elseif(isset($_POST['delete_'])){
                $id = (int)$_POST['id_video'];
                $trangthai = $_POST['delete_'];
                if($trangthai == "1"){
                    $query = "DELETE FROM `feature` Where `id_video` = '$id';";
                    $result = $this->DB->query($query);
            
                }elseif($trangthai == "0"){
                    $query = "DELETE FROM `vipham` Where `id_video` = '$id';";
                    $result = $this->DB->query($query);
                }
            }
        }
        header("Location: index.php");
        return;
    }

    public function logout(){
        // xóa cookies username đi
        setcookie("username", "", time() - 3600, '/');
        header("Location: index.php?action=login");
        return;
    }
}
?>