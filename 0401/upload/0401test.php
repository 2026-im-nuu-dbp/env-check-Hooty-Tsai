<?php
// 後端邏輯：連接資料庫
$host = 'localhost';
$db   = 'test_db';
$user = 'root';
$pass = ''; // Laragon 預設無密碼

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 取得資料
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("資料庫連線失敗: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
     …
</head>
<body>
    <div>
        <h1>資料庫內容</h1>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?php echo $user['name']; ?> (<?php echo $user['email']; ?>)</li>
            <?php endforeach; ?>
        </ul>
    </div>
    </body>
</html>
