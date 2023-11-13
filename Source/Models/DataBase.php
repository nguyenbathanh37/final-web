<?php
class DataBase{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "qlvideo";
    public $conn;

    public function __construct()
    {
        // Kết nối database
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    // Thực hiện truy vấn
    public function query($query)
    {
        return $this->conn->query($query);
    }

    // Thực hiện truy vấn có truyền đối số
    public function exec($query, $format, $param)
    {
        $sttm = $this->conn->prepare($query);
        $sttm->bind_param($format, ...$param);
        return $sttm->execute();
    }

    // Đóng kết nối
    public function close(){
        $this->conn->close();
    }
}
?>