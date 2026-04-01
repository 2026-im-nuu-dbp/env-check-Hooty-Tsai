<?php
require 'db.php';

// 4. 顯示所有使用者
$sql = "SELECT * FROM users";
$users = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) {
    echo "<p>{$user['name']} ({$user['email']})</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>




</head>
<body>

    <h1>刪除</h1>
    <p>刪除的使用者</p>

    <form action="db3.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <input type="submit" value="Insert">
    </form>






</body>
</html>