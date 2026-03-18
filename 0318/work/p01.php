<?php
// 第1題：產生 100 個 0-1000 的隨機數並檢查質數

// 判斷數值是否為質數的函式
function isPrime($n) {
    // 0、1 非質數
    if ($n <= 1) {
        return false;
    }
    // 2 與 3 為質數
    if ($n <= 3) {
        return true;
    }
    // 排除偶數
    if ($n % 2 === 0) {
        return $n === 2;
    }
    // 只測試到平方根
    $limit = floor(sqrt($n));
    for ($i = 3; $i <= $limit; $i += 2) {
        if ($n % $i === 0) {
            return false;
        }
    }
    return true;
}

// 生成 100 個隨機數
$nums = [];
for ($i = 0; $i < 100; $i++) {
    $nums[] = rand(0, 1000);
}

// 輸出 HTML
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>p01</title></head><body>';
echo '<h2>第1題：100個隨機數值與質數檢查</h2>';
echo '<table border="1" cellpadding="6" cellspacing="0">';
echo '<tr><th>#</th><th>數值</th><th>是否質數</th></tr>';
foreach ($nums as $index => $value) {
    // 將每個數字與質數判斷結果顯示在表格內
    echo '<tr><td>' . ($index + 1) . '</td><td>' . $value . '</td><td>' . (isPrime($value) ? '是' : '否') . '</td></tr>';
}
echo '</table>';
echo '</body></html>';
