<?php
class Student {
    // Khởi tạo SESSION với dữ liệu mẫu nếu chưa có
    public static function initSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['students'])) {
            $_SESSION['students'] = [
                ["id" => 1, "name" => "Nguyen Van A", "major" => "CNTT"],
                ["id" => 2, "name" => "Tran Thi B", "major" => "Kinh tế"],
                ["id" => 3, "name" => "Le Van C", "major" => "Điện tử"],
                ["id" => 4, "name" => "Pham Van D", "major" => "CNTT"],
                ["id" => 5, "name" => "Hoang Thi E", "major" => "Kinh tế"],
                ["id" => 6, "name" => "Vo Van F", "major" => "Cơ khí"],
                ["id" => 7, "name" => "Dang Thi G", "major" => "Điện tử"],
                ["id" => 8, "name" => "Bui Van H", "major" => "CNTT"],
            ];
            $_SESSION['next_id'] = 9;
        }
    }

    // Lấy tất cả sinh viên
    public static function getAllStudents() {
        self::initSession();
        return $_SESSION['students'];
    }

    // Lấy sinh viên theo ID
    public static function getStudentById($id) {
        self::initSession();
        foreach ($_SESSION['students'] as $student) {
            if ($student['id'] == $id) {
                return $student;
            }
        }
        return null;
    }

    // Thêm sinh viên mới
    public static function addStudent($name, $major) {
        self::initSession();
        $newStudent = [
            "id" => $_SESSION['next_id'],
            "name" => $name,
            "major" => $major
        ];
        $_SESSION['students'][] = $newStudent;
        $_SESSION['next_id']++;
        return true;
    }

    // Xóa sinh viên theo ID
    public static function deleteStudent($id) {
        self::initSession();
        foreach ($_SESSION['students'] as $key => $student) {
            if ($student['id'] == $id) {
                unset($_SESSION['students'][$key]);
                $_SESSION['students'] = array_values($_SESSION['students']);
                return true;
            }
        }
        return false;
    }

    // Cập nhật sinh viên
    public static function updateStudent($id, $name, $major) {
        self::initSession();
        foreach ($_SESSION['students'] as &$student) {
            if ($student['id'] == $id) {
                $student['name'] = $name;
                $student['major'] = $major;
                return true;
            }
        }
        return false;
    }

    // Tìm kiếm sinh viên theo tên hoặc ID
    public static function search($keyword) {
        self::initSession();
        $results = [];
        foreach ($_SESSION['students'] as $student) {
            if ($student['id'] == $keyword || mb_stripos($student['name'], $keyword) !== false) {
                $results[] = $student;
            }
        }
        return $results;
    }
}
?>
