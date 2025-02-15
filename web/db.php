<?php
$host = "localhost";
$dbname = "minecraft_server";
$username = "root";  // MySQLのユーザー名
$password = "";      // MySQLのパスワード

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}
?>
