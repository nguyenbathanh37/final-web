<?php
include('BaseController.php');

class UserController extends BaseController
{
    private $DB, $videoModel, $userModel;

    public function __construct()
    {
        // Khởi tạo và kết nối database
        $this->DB = $this->model('DataBase');

        // Khởi tạo model
        $this->videoModel = $this->model('VideoModel');
        $this->userModel = $this->model('UserModel');
    }

    public function index()
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }
        $username = $_COOKIE["username"];

        $sql = "SELECT v.*, u.fullname, u.img, u.email FROM video v, user u WHERE v.username = u.username and v.username = '$username' and v.id_video not in (SELECT id_video FROM vipham)";
        $result = $this->DB->query($sql);
        $data = array();

        // nạp dữ liệu
        if ($result->num_rows > 0) {
            while ($r = $result->fetch_assoc()) {
                $view = (int)$r["view"];
                $view_format = '';
                while ($view > 1000) {
                    $remain = $view % 1000;
                    $view = (int)($view / 1000);
                    $view_format = ',' . $remain . $view_format;
                }
                $view_format = $view . $view_format;
                $data[] = ["id_video" => $r["id_video"], "namevideo" => $r["namevideo"], "view" => $view_format, "dayupload" => $r["dayupload"], "thumbnail" => $r["thumbnail"], "mode" => $r["mode"], "fullname" => $r["fullname"], "link" => $r["link"], "avt" => $r["img"], "email" => $r["email"]];
            }
        }
        $user = $this->DB->query("SELECT * from user where username = '$username'");
        $user = $user->fetch_assoc();

        $content = array('data' => $data, 'user' => $user);
        return $this->view("User/Profile.php", $content);
    }

    public function subscribed($page = 1)
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }

        // Lấy ảnh đại diện của user;
        $avt = $this->getAvatar();

        // Số item trong 1 trang
        $videos_per_page = 10;

        // số trang có thể có
        $query = "SELECT * FROM video WHERE mode=0 and id_video not in (SELECT id_video FROM vipham)";
        $result = $this->DB->query($query);
        $num_of_videos = mysqli_num_rows($result);
        $num_of_page = ceil($num_of_videos / $videos_per_page);

        // số trang đầu tiên 
        $page_first_result = ($page - 1) * $videos_per_page;

        $listUser = $this->userModel->getUserSubscribed($page_first_result, $videos_per_page);
        $content = array('listUser' => $listUser, 'avt' => $avt, 'num_of_page' => $num_of_page);

        return $this->view("User/Subscribed.php", $content);
    }

    public function liked($page = 1)
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }

        $username = $_COOKIE["username"];

        // Lấy ảnh đại diện của user;
        $avt = $this->getAvatar();

        // Số item trong 1 trang
        $videos_per_page = 10;
        // số trang có thể có
        $query = "SELECT * FROM video WHERE mode=0 and username = '$username' and id_video not in (SELECT id_video FROM vipham)";
        $result = $this->DB->query($query);
        $num_of_videos = mysqli_num_rows($result);
        $num_of_page = ceil($num_of_videos / $videos_per_page);
        // số trang đầu tiên 
        $page_first_result = ($page - 1) * $videos_per_page;

        $listVideo = $this->videoModel->getVideoLiked($page_first_result, $videos_per_page);
        $content = array('listVideo' => $listVideo, 'avt' => $avt, 'num_of_page' => $num_of_page);

        return $this->view("Home/Home.php", $content);
    }

    public function history($page = 1)
    {
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }
        $username = $_COOKIE["username"];

        // Lấy ảnh đại diện của user;
        $avt = $this->getAvatar();

        // Lấy ảnh đại diện của user;
        $avt = $this->getAvatar();

        // Số item trong 1 trang
        $videos_per_page = 10;
        // số trang có thể có
        $query = "SELECT * FROM video WHERE mode=0 and username = '$username' and id_video not in (SELECT id_video FROM vipham)";
        $result = $this->DB->query($query);
        $num_of_videos = mysqli_num_rows($result);
        $num_of_page = ceil($num_of_videos / $videos_per_page);
        // số trang đầu tiên 
        $page_first_result = ($page - 1) * $videos_per_page;

        $listVideo = $this->videoModel->getHistory($page_first_result, $videos_per_page);
        $content = array('listVideo' => $listVideo, 'avt' => $avt, 'num_of_page' => $num_of_page);

        return $this->view("Home/Home.php", $content);
    }

    public function mylist($page = 1)
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }

        // Lấy và nạp dữ liệu
        $username = $_COOKIE["username"];
        $sql = "SELECT n.* from playlist p, nameplaylist n where p.id_playlist = n.id_playlist and p.username = '$username' group by id_playlist";
        $result = $this->DB->query($sql);
        $data = array();
        if($result->num_rows > 0){
            while($r = $result->fetch_assoc()){
                $data[] = array("id_playlist"=>$r["id_playlist"], "name_playlist"=>$r["name_playlist"], "username"=>$username);
            }
        }

        $content = array('data'=>$data);
        return $this->view("User/Playlist.php", $content);
    }

    public function getPlaylist($id)
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }

        // Lấy và nạp dữ liệu
        $sql = "SELECT v.*, u.fullname, u.img from playlist p, video v, user u where p.id_playlist = $id and v.id_video = p.id_video and u.username = v.username and v.id_video not in (SELECT id_video FROM vipham)";
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

        $content = array('listVideo'=>$data_videos);
        return $this->view("Home/Home.php", $content);
    }

    public function comment()
    {
        // Kiểm tra người dùng có đăng nhập chưa
        if (!$this->checkLogin()) {
            header("Location: index.php");
            return;
        }
        $username = $_COOKIE['username'];
        $content = $_POST["comment-area"];
        $id_video = $_GET['id'];

        // Thêm comment vào database
        $sql = "INSERT INTO comment (username, content, id_video) VALUES (?, ?, ?)";
        $param = [$username, $content, $id_video];
        $this->DB->exec($sql, "sss", $param);
        $this->DB->close();
        header("Location: index.php?controller=Video&action=watch&id=" . $id_video);
    }



    // Lấy ảnh đại diện của user;
    public function getAvatar()
    {
        $username = $_COOKIE["username"];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $data = $this->DB->query($sql);
        $r = $data->fetch_assoc();
        $avt = $r["img"];
        return $avt;
    }

    public function changeProfile()
    {
        // Kiểm tra  người dùng có điền đầy đủ thông tin
        if (!(empty($_POST['avt-img-src']) || empty($_POST['full_name']) || empty($_POST['email']))) {
            $image = $_POST['avt-img-src'];
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];

            // $username = $_COOKIE["username"];
            $username = $_COOKIE["username"];
            $sql = "UPDATE user SET fullname=?, email=?, img=? WHERE username='$username'";
            $param = [$full_name, $email, $image];
            $this->DB->exec($sql, 'sss', $param);
            header("Location: index.php?controller=User");
            return;
        }
        $avt = $this->getAvatar();
        $content = array('avt' => $avt);
        return $this->view("User/ChangeProfile.php", $content);
    }

    // Trả về giao diện upload
    public function upload(array $errorMessage = [], array $successMessage = [])
    {
        $query = "SELECT * FROM `nameplaylist`";
        $result = $this->DB->query($query);
        $result = $result->fetch_all();
        $content = array('result' => $result, "errorMessage" => $errorMessage, "successMessage"=>$successMessage);
        return $this->view("User/Upload.php", $content);
    }

    // xử lí upload bằng file
    public function uploadFile()
    {
        $errorMessage = array();
        $successMessage = array();
        $username = $_COOKIE["username"];
        if (isset($_POST['submitFILE'])) {
            if (isset($_FILES['fileToUpload']['name']) && $_FILES['imgthumbnails']['name'] != '' && $_FILES['fileToUpload']['name'] != '' && isset($_POST['title_file']) && !empty($_POST['title_file'])) {
                $title = $_POST['title_file'];
                $maxsize = 524288000;
                $target_dir = "assets/videos/";
                $target_dir_thumbails = "assets/images/";
                $target_file_thumbails =  $target_dir_thumbails . basename($_FILES["imgthumbnails"]["name"]);
                $target_file =  $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $vis = 1;
                if (isset($_POST['radiovis'])) {
                    if ($_POST['radiovis'] === 'public') {
                        $vis = 1;
                    }
                    if ($_POST['radiovis'] === 'private') {
                        $vis = 0;
                    }
                }
                $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $extension_thumbnail = strtolower(pathinfo($target_file_thumbails, PATHINFO_EXTENSION));

                // Valid file extensions
                $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");
                if (in_array($extension, $extensions_arr)) {
                    // Check file size
                    if (($_FILES['fileToUpload']['size'] >= $maxsize) || ($_FILES["fileToUpload"]["size"] == 0)) {
                        $errorMessage[] = "File too large. File must be less than 500MB.";
                    } else {
                        $target_file_temp = "assets/videos/video.".$extension;
                        $target_file_thumbails = "assets/images/thumnail.".$extension_thumbnail;

                        // Kiểm tra tên file có bị trùng
                        $c = 1;
                        while (file_exists($target_file_temp)) {
                            $target_file_temp = 'assets/videos/video(' . $c . ').' . $extension;
                            $c++;
                        }

                        // Kiểm tra tên file có bị trùng
                        $c = 1;
                        while (file_exists($target_file_thumbails)) {
                            $target_file_thumbails = 'assets/images/thumnail(' . $c . ').' . $extension_thumbnail;
                            $c++;
                        }

                        // di chuyển file vào folder để lưu
                        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
                        move_uploaded_file($_FILES['imgthumbnails']['tmp_name'], $target_file_thumbails);

                        // Insert record
                        $query = "INSERT INTO `video` (`namevideo`, `view`, `dayupload`,`thumbnail`,`mode`, `username`, `link`) VALUES
                            ('$title', 0, CURRENT_TIMESTAMP,'$target_file_thumbails','$vis','$username','$target_file_temp');";
                        $this->DB->query($query);

                        $query = "SELECT `id_video` FROM `video` WHERE `link` = '$target_file_temp';";
                        $result = $this->DB->query($query);
                        $result = $result->fetch_assoc();

                        $id_playlist  = $_POST['playlist-select'];
                        $query = "INSERT INTO `playlist` (`id_playlist`, `id_video`, `username`) VALUES
                            ('$id_playlist','" . $result["id_video"] . ",'$username');";
                        $this->DB->query($query);

                        $errorMessage[] = "Upload successfully.";
                    }
                } else {
                    $errorMessage[] = "Invalid file extension.";
                }
            } else {
                $errorMessage[] = "Please select a file.";
            }
        }

        // trả về giao diện upload
        $this->upload($errorMessage, $successMessage);
        return;
    }

    public function uploadURL()
    {
        $username = $_COOKIE["username"];
        $errorMessage = array();
        $successMessage = array();
        if (isset($_POST['submitURL'])) {
            // Kiểm tra người dùng có nhập đầy đủ không
            if (isset($_POST['url']) && isset($_POST['title_url'])  && $_FILES['imgthumbnails']['name'] != '' && !empty($_POST['url']) && !empty($_POST['title_url'])) {
                $url = $_POST['url'];
                $title = $_POST['title_url'];
                $pos = strpos($url, 'http');

                $extension_thumbnail = strtolower(pathinfo($_FILES['imgthumbnails']['name'], PATHINFO_EXTENSION));
                $target_file_thumbails_ = "/assets/images/thumnail.".$extension_thumbnail;

                // Kiểm tra tên file có bị trùng
                $c = 1;
                while (file_exists($target_file_thumbails_)) {
                    $target_file_thumbails_ = "assets/images/thumnail(" . $c . ")." . $extension_thumbnail;
                    $c++;
                }
                $vis = 1;
                if (isset($_POST['radiovis'])) {
                    if ($_POST['radiovis'] === 'public') {
                        $vis = 1;
                    }
                    if ($_POST['radiovis'] === 'private') {
                        $vis = 0;
                    }
                }
                if ($pos !== false) {
                    // tim thay

                        move_uploaded_file($_FILES['imgthumbnails']['tmp_name'], $target_file_thumbails_);
                            $query = "INSERT INTO `video` (`namevideo`, `view`, `dayupload`,`thumbnail`,`mode`, `username`, `link`) VALUES
                        ('$title',0,CURRENT_TIMESTAMP,'$target_file_thumbails_','$vis','$username','$url');";
                            $this->DB->query($query);


                            $query = "SELECT `id_video` FROM `video` WHERE `username` = '$username' and `link` = '$url';";
                            $result = $this->DB->query($query);
                            $result = $result->fetch_array();
                            $id_playlist  = $_POST['playlist-select'];
                            $query = "INSERT INTO `playlist` (`id_playlist`, `id_video`, `username`) VALUES
                                        ('$id_playlist','".$result[0]."','$username');";
                            $this->DB->query($query);

                            $successMessage[] ="Upload thành công";
                        
                } else {
                    $errorMessage[] = 'Không tìm thấy';
                }
            }
        }
        $this->upload($errorMessage, $successMessage);
        return;
    }

    public function getProfileOfUser($username = "")
    {
        // Lấy và nạp dữ liệu
        $sql = "SELECT v.*, u.fullname, u.img, u.email FROM video v, user u WHERE v.username = u.username and mode = 0 and v.username = '$username' and v.id_video not in (SELECT id_video FROM vipham)";
        $result = $this->DB->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($r = $result->fetch_assoc()) {
                $view = (int)$r["view"];
                $view_format = '';
                while ($view > 1000) {
                    $remain = $view % 1000;
                    $view = (int)($view / 1000);
                    $view_format = ',' . $remain . $view_format;
                }
                $view_format = $view . $view_format;
                $data[] = ["id_video" => $r["id_video"], "namevideo" => $r["namevideo"], "view" => $view_format, "dayupload" => $r["dayupload"], "thumbnail" => $r["thumbnail"], "mode" => $r["mode"], "fullname" => $r["fullname"], "link" => $r["link"], "avt" => $r["img"], "email" => $r["email"]];
            }
        }
        $user = $this->DB->query("SELECT * from user where username = '$username'");
        $user = $user->fetch_assoc();

        $content = array('data' => $data, 'user' => $user);
        return $this->view("User/Profile.php", $content);
    }
}
?>