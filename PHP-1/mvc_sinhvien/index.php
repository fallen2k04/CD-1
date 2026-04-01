<?php
require_once __DIR__ . "/controller/StudentController.php";

$controller = new StudentController();
$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->addStudent();
        }
        else {
            $controller->addForm();
        }
        break;

    case 'delete':
        $controller->deleteStudent();
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updateStudent();
        }
        else {
            $controller->editForm();
        }
        break;

    case 'list':
    default:
        $controller->listStudents();
        break;
}
?>
