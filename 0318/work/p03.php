<?php
// 第3題：讀取 data.csv，計算總和並以表格顯示

// 讀取檔案
date_default_timezone_set('Asia/Taipei');
$csvFile = __DIR__ . '/data.csv';
$rows = [];
if (($handle = fopen($csvFile, 'r')) !== false) {
    // 每一行用 fgetcsv 讀取....
    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) >= 3) {
            // 將欄位轉成我們需要的資料格式
            $rows[] = [
                'name' => trim($data[0]),
                'qty' => (int) trim($data[1]),
                'price' => (int) trim($data[2]),
            ];
        }
    }
    fclose($handle);
}

// 計算總和
$totalQty = 0;
$totalPrice = 0;
$totalAmount = 0;

foreach ($rows as $row) {
    $totalQty += $row['qty'];
    $totalPrice += $row['price'];
    $totalAmount += $row['qty'] * $row['price'];
}

// 輸出結果
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>p03</title></head><body>';
echo '<h2>第3題：讀取 data.csv 並顯示表格</h2>';
echo '<table border="1" cellpadding="6" cellspacing="0">';
echo '<tr><th>名稱</th><th>數量</th><th>單價</th><th>小計</th></tr>';
foreach ($rows as $row) {
    $amount = $row['qty'] * $row['price'];
    echo '<tr><td>' . htmlspecialchars($row['name']) . '</td><td>' . $row['qty'] . '</td><td>' . $row['price'] . '</td><td>' . $amount . '</td></tr>';
}
echo '<tr style="font-weight:bold;"><td>總和</td><td>' . $totalQty . '</td><td>' . $totalPrice . '</td><td>' . $totalAmount . '</td></tr>';
echo '</table>';
echo '</body></html>';
