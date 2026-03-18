<?php
// 第2題：讀取時間並計算 y+m+d+h+n+s，並檢查總和是否為質數

date_default_timezone_set('Asia/Taipei');

// 取得各時間數值
$y = date('Y');
$m = date('n');
$d = date('j');
$h = date('G');
$n = date('i');
$s = date('s');

// 計算總和
$sum = $y + $m + $d + $h + $n + $s;

// 判斷質數函式（輸入 n，回傳 true/false）
function isPrime2($n) {
    if ($n <= 1) return false; // 0、1 不是質數
    if ($n <= 3) return true; // 2、3 是質數
    if ($n % 2 === 0) return false; // 排除偶數
    $r = floor(sqrt($n));
    for ($i = 3; $i <= $r; $i += 2) {
        if ($n % $i === 0) return false;
    }
    return true;
}

echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>p02</title></head><body>';
echo '<h2>第2題：讀取時間並計算合計</h2>';
echo '<p>目前時間：' . date('Y-m-d H:i:s') . '</p>';
echo '<p>y=' . $y . ', m=' . $m . ', d=' . $d . ', h=' . $h . ', n=' . $n . ', s=' . $s . '</p>';
echo '<p>總和 y+m+d+h+n+s = ' . $sum . '</p>';
echo '<p>是否質數：' . (isPrime2($sum) ? '是' : '否') . '</p>';
echo '</body></html>';
