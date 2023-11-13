<?php    
    include 'BaseController.php';

    class HomeController extends BaseController{
        private $DB, $videoModel;

        public function __construct() {
            // Khởi tạo và kết nối database
            $this->DB = $this->model('DataBase');
            // Khởi tạo model
            $this->videoModel = $this->model('VideoModel');
        }

        public function index($page = 1)
        {
            // kiểm tra người dùng đã đăng nhập chưa
            if(!isset($_COOKIE["username"])){
                header("Location: index.php?action=login");
                return;
            }

            // Lấy ảnh đại diện của user;
            $username = $_COOKIE["username"];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $data = $this->DB->query($sql);
            $r = $data->fetch_assoc();
            $avt = $r["img"];
            
            // Số item trong 1 trang
            $videos_per_page = 10;

            // số trang có thể có
            $query = "SELECT v.* FROM feature f, video v WHERE f.id_video = v.id_video and mode = 0 and v.id_video not in (SELECT id_video FROM vipham)";
            $result = $this->DB->query($query);
            $num_of_videos = mysqli_num_rows($result);
            $num_of_page = ceil($num_of_videos / $videos_per_page);

            // số trang đầu tiên 
            $page_first_result = ($page-1) * $videos_per_page;
            $listVideo = $this->videoModel->getVideoFeature($page_first_result, $videos_per_page);
            
            $content = array('listVideo'=>$listVideo, 'avt'=>$avt, 'num_of_page'=>$num_of_page);
            return $this->view("Home/Home.php", $content);
        }
        
        public function login()
        {
            // kiểm tra xem người dùng đã đăng nhập chưa
            if(isset($_COOKIE["username"])){
                header("Location: index.php");
                return;
            }
            $errorMessage = array();
            $username = '';
            $password = '';
            if(isset($_POST["submit"])){
                $username = $_POST["username"];
                $password = $_POST["password"];

                // Kiểm tra có phải admin đang đăng nhập
                if($username == "admin"){
                    if($password == "123456"){
                        // trả về trang quản trị
                        setcookie("username", $username, time() + 30*24*60*60, '/');
                        header("Location: index.php?controller=Admin");
                        return;
                    }else{
                        array_push($errorMessage, 'Sai mật khẩu');
                    }
                }else{
                    // Lấy tài khoản từ database
                    $sql = "SELECT * FROM user WHERE username = '$username'"; 
                    $user = $this->DB->query($sql);
                    if($user->num_rows != 0){
                        $r = $user->fetch_assoc();

                        // kiểm tra xem mật khẩu có đúng không
                        if($r['password'] == $password){
                            setcookie("username", $username, time() + 30*24*60*60, '/');
                            header("Location: index.php");
                            return;
                        }else array_push($errorMessage, 'Sai mật khẩu');
                    }else{
                        array_push($errorMessage, 'Tài khoản không tồn tại');
                    }
                }
            }
            $content = array('errorMessage'=>$errorMessage, 'username'=>$username, 'password'=>$password);
            return $this->view("SignIn_SignUp/SignIn.php", $content);
        }

        public function logup(){
            // kiểm tra xem người dùng đã đăng nhập chưa
            if(isset($_COOKIE["username"])){
                header("Location: index.php");
                return;
            }
            $errorMessage = array();
            $fullname = $username = $password = $email = $confirm_password = '';
            if(isset($_POST["submit"])){
                $fullname = $_POST["fullname"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $email = $_POST["email"];
                $confirm_password = $_POST["confirm_password"];

                // kiểm tra xem mật khẩu và mật khẩu nhập lại có giống nhau không
                if($password != $confirm_password) 
                    array_push($errorMessage, 'Mật khẩu nhập lại không khớp.');

                // kiểm tra xem username đã được sử dụng chưa
                $sql = "SELECT * FROM user WHERE username = '$username'"; 
                $data = $this->DB->query($sql);
                if($data->num_rows != 0){
                    array_push($errorMessage, 'username đã được sử dụng');
                }else{
                    // thêm tài khoản vào database
                    $sql = "INSERT INTO user (username, password, fullname, email, img) VALUES(?, ?, ?, ?, 'assets/images/non-avt.png')";
                    $param = [$username, $password, $fullname, $email];
                    $this->DB->exec($sql, 'ssss', $param);
                    header("Location: index.php?action=login");
                    return;
                }
            }
            $content = array('errorMessage'=> $errorMessage, 'fullname'=>$fullname, 'username'=>$username, 'password'=>$password, 'email'=>$email, 'confirm_password'=>$confirm_password);
            return $this->view("SignIn_SignUp/SignUp.php", $content);
        }

        public function logout(){
            // xóa cookies username đi
            setcookie("username", "", time() - 3600, '/');
            header("Location: index.php?action=login");
            return;
        }

        // Tìm kiếm
        public function search($search_input)
        {
            // Lấy avatar của user
            $username = $_COOKIE["username"];
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $data = $this->DB->query($sql);
            $r = $data->fetch_assoc();
            $avt = $r["img"];

            // Số dữ liệu trên 1 trang
            $videos_per_page = 10;

            // Kiểm tra từ khóa có hợp lệ hay không
            if(isset($search_input) && !empty($search_input) && trim($search_input)!=''){
                $key_word = $search_input;
                $sql = "SELECT v.*, u.fullname, u.img FROM video v, user u WHERE (v.namevideo LIKE '%$key_word%' OR v.username LIKE '%$key_word%') AND v.username = u.username and v.mode=0 and v.id_video not in (SELECT id_video FROM vipham) LIMIT ". $videos_per_page;
            }else {
                // trả về trang chủ nếu không hợp lệ
                header("Location: index.php");
                return;
            }
            
            $result = $this->DB->query($sql);
            $video = [];

            // nạp dữ liệu
            while($r = $result->fetch_assoc()){
                $view = (int)$r["view"];
                    $view_format = '';
                    while($view > 1000){
                        $remain = $view%1000;
                        $view = (int)($view/1000);
                        $view_format = ','.$remain.$view_format;
                    }
                    $view_format = $view.$view_format;
                $video[] = ["id_video"=>$r["id_video"],"namevideo"=>$r["namevideo"],"view"=>$view_format,"dayupload"=>$r["dayupload"],"thumbnail"=>$r["thumbnail"], "mode"=>$r["mode"], "fullname"=>$r["fullname"], "link"=>$r["link"], "avt"=>$r["img"]];
            }

            // Trả về trang chủ
            $content = array('listVideo'=>$video, "search_input"=>$search_input, 'avt'=>$avt, 'num_of_page'=>1);
            return $this->view("Home/Home.php", $content);
        }
    }
?>