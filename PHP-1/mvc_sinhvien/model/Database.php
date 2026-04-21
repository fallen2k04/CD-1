<?php
class Database {
    private $host = "127.0.0.1";
    private $db_name = "mvc_sinhvien_db";
    private $username = "root";
    private $password = "";
    private $port = "3307"; // Dùng port 3307 vì 3306 đã bị chiếm
    public $conn;

    // Lấy kết nối CSDL và tạo DB/Table nếu chưa có
    public function getConnection() {
        $this->conn = null;
        try {
            // Lấy port từ CSDL thực tế nếu đang mở bằng XAMPP
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Tạo Database nếu chưa tồn tại
            $this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name . " CHARACTER SET utf8 COLLATE utf8_unicode_ci");
            $this->conn->exec("USE " . $this->db_name);

            // Tạo Table sinh viên nếu chưa tồn tại
            $sql = "CREATE TABLE IF NOT EXISTS students (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                major VARCHAR(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            $this->conn->exec($sql);

            // Chèn dữ liệu mẫu nếu bảng trống
            $stmt = $this->conn->query("SELECT COUNT(*) FROM students");
            if ($stmt->fetchColumn() == 0) {
                $this->conn->exec("INSERT INTO students (name, major) VALUES 
                    ('Nguyen Van A', 'CNTT'),
                    ('Tran Thi B', 'Kinh tế'),
                    ('Le Van C', 'Điện tử'),
                    ('Pham Van D', 'CNTT'),
                    ('Hoang Thi E', 'Kinh tế'),
                    ('Vo Van F', 'Cơ khí'),
                    ('Dang Thi G', 'Điện tử'),
                    ('Bui Van H', 'CNTT')
                ");
            }

        } catch(PDOException $exception) {
            echo "Lỗi kết nối CSDL: " . $exception->getMessage();
            die();
        }
        return $this->conn;
    }
}
?>
