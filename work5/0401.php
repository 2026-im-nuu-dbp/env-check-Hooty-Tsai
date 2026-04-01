<?php
// 取得當下的 2026-04-01 11:42:00 格式
$currentTime = date('Y-m-d H:i:s'); 

// 執行寫入或刪除
$stmt->execute([
    'name' => $name, 
    'email' => $email,
    'time' => $currentTime
]);





?>