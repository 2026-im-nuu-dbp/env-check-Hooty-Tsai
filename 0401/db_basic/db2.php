<?php
require 'db.php';
// 1. 準備 SQL 語法 (具名占位符)
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");


//2. 執行並綁定參數
$name = $_POST['name']; // 從表單接收名稱
$email = $_POST['email']; // 從表單接收郵箱


$stmt->execute(['name' => $name, 'email' => $email]);

// // 3. 準備 SQL 語法 (問號占位符)
// $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (?, ?)");

// // 4. 執行並綁定參數 依照順序
// $stmt->execute(['Jane', 'jane@example.com']);

// 5. 顯示所有使用者
$sql = "SELECT * FROM users";
$users = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) {
    echo "<p>{$user['name']} ({$user['email']})</p>";
}

?>