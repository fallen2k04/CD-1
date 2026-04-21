<?php
$host = '127.0.0.1';
$db   = 'student_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=3307;charset=$charset";
try {
     $pdo = new PDO($dsn, $user, $pass);
     $pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
     $pdo->exec("USE $db");
     $stmt = $pdo->query("SHOW TABLES LIKE 'students'");
     if ($stmt->rowCount() > 0) {
         echo "TABLE_EXISTS";
     } else {
         echo "TABLE_NOT_FOUND";
         // Try to create it manually if not found
         $sql = "CREATE TABLE students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            major VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
         )";
         $pdo->exec($sql);
         echo "TABLE_CREATED_MANUALLY";
     }
} catch (\PDOException $e) {
     echo "CONNECTION_ERROR: " . $e->getMessage();
}
?>
