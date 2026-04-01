<?php
require_once __DIR__ . "/../model/Student.php";

class StudentController {

    // Validate dữ liệu sinh viên
    private function validate($name, $major) {
        $errors = [];
        if (empty(trim($name))) {
            $errors[] = "Họ tên không được để trống.";
        } elseif (mb_strlen(trim($name)) < 3) {
            $errors[] = "Họ tên phải có ít nhất 3 ký tự.";
        }
        if (empty(trim($major))) {
            $errors[] = "Ngành học không được để trống.";
        }
        return $errors;
    }

    // Hiển thị danh sách sinh viên (có phân trang + tìm kiếm)
    public function listStudents() {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        if ($keyword !== '') {
            $allStudents = Student::search($keyword);
        } else {
            $allStudents = Student::getAllStudents();
        }

        // Phân trang: 5 sinh viên / trang
        $perPage = 5;
        $totalStudents = count($allStudents);
        $totalPages = max(1, ceil($totalStudents / $perPage));
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $totalPages) $page = $totalPages;
        $offset = ($page - 1) * $perPage;
        $students = array_slice($allStudents, $offset, $perPage);

        include __DIR__ . "/../view/student_list.php";
    }

    // Hiển thị form thêm sinh viên
    public function addForm() {
        $errors = [];
        $name = '';
        $major = '';
        include __DIR__ . "/../view/student_add.php";
    }

    // Xử lý thêm sinh viên
    public function addStudent() {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $major = isset($_POST['major']) ? $_POST['major'] : '';
        $errors = $this->validate($name, $major);

        if (empty($errors)) {
            Student::addStudent(trim($name), trim($major));
            header("Location: index.php?action=list");
            exit;
        }

        // Nếu có lỗi, hiển thị lại form
        include __DIR__ . "/../view/student_add.php";
    }

    // Xóa sinh viên
    public function deleteStudent() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        Student::deleteStudent($id);
        header("Location: index.php?action=list");
        exit;
    }

    // Hiển thị form sửa sinh viên
    public function editForm() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $student = Student::getStudentById($id);
        if (!$student) {
            header("Location: index.php?action=list");
            exit;
        }
        $errors = [];
        $name = $student['name'];
        $major = $student['major'];
        include __DIR__ . "/../view/student_edit.php";
    }

    // Xử lý cập nhật sinh viên
    public function updateStudent() {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $major = isset($_POST['major']) ? $_POST['major'] : '';
        $errors = $this->validate($name, $major);

        if (empty($errors)) {
            Student::updateStudent($id, trim($name), trim($major));
            header("Location: index.php?action=list");
            exit;
        }

        // Nếu có lỗi, hiển thị lại form
        $student = ['id' => $id, 'name' => $name, 'major' => $major];
        include __DIR__ . "/../view/student_edit.php";
    }
}
?>
