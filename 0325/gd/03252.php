<?php
header("Content-Type: image/png");

// 從 data.csv 讀取資料，存在 $data[] 中
$csv_str = file_get_contents('data.csv');
$data = array_map('intval', array_map('trim', explode(',', $csv_str)));

// 圖片尺寸：寬 500 高 300
$w = 500;
$h = 300;
$im = imagecreatetruecolor($w, $h);

// 定義顏色
$white = imagecolorallocate($im, 255, 255, 255);
$red = imagecolorallocate($im, 255, 0, 0);
$black = imagecolorallocate($im, 0, 0, 0);
$gray = imagecolorallocate($im, 200, 200, 200);

// 填充背景
imagefill($im, 0, 0, $white);

// 繪製座標軸
imageline($im, 40, 10, 40, 290, $black);   // Y軸
imageline($im, 40, 290, 460, 290, $black); // X軸

// 附加刻度線
for ($y = 50; $y <= 290; $y += 40) {
    imageline($im, 35, $y, 40, $y, $gray);
}

// 計算與繪製長條
// 一些計算：5+6 = 11, 500 / 11 約 45
// 300 上下各留 10, 280 / 700 = 4/10
// 資料的高分別為 300*2/5, 200*2/5, 700*2/5, 50*2/5, 125*2/5

$h_array = array();
for ($i = 0; $i < count($data); $i++) {
    // 計算每個數據對應的高度
    $h_array[$i] = $data[$i] * 2.0 / 5.0;
}

// 繪製長條
// 長條的位置 (45 + (90*$i), 280 – 高 + 10), 右下角(X+45, 290)
for ($i = 0; $i < count($data); $i++) {
    $x1 = 45 + (90 * $i);
    $y1 = 280 - $h_array[$i] + 10;
    $x2 = $x1 + 45;  // 寬度 45
    $y2 = 290;
    
    imagefilledrectangle($im, $x1, $y1, $x2, $y2, $red);
    
    // 在長條上方顯示數值
    $text = (string)$data[$i];
    imagestring($im, 2, $x1 + 10, $y1 - 15, $text, $black);
}

// 輸出圖片
imagepng($im);
imagedestroy($im);
?>