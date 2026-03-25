<?php
// 1. 設定標頭
header("Content-Type: image/png");

// 2. 讀取 data.csv (依照圖片要求：300, 200, 700, 50, 125)
// 如果檔案不存在，我們手動建立一個陣列模擬
if (file_exists('data.csv')) {
    $data = array_map('intval', explode(',', trim(file_get_contents('data.csv'))));
} else {
    $data = array(300, 200, 700, 50, 125);
}

// 3. 建立圖片 (寬 500, 高 300)
$im = imagecreatetruecolor(600, 400);

// 4. 定義顏色
$white = imagecolorallocate($im, 255, 255, 255);
$red   = imagecolorallocate($im, 255, 0, 0);
$black = imagecolorallocate($im, 0, 0, 0);

// 填充背景色
imagefill($im, 0, 0, $white);



// 5. 繪製軸線 (選配，讓圖表更完整)
imageline($im, 40, 10, 40, 290, $black);  // 縱軸
imageline($im, 40, 290, 490, 290, $black); // 橫軸

// 6. 依照圖片公式進行繪製
for ($i = 0; $i < 5; $i++) {
    // 高度計算：資料 * 2 / 5 (圖片中的 280/700 = 4/10 比例)
    $h[$i] = $data[$i] * 2.0 / 5.0; 
    
    // 圖片要求的矩形座標公式：
    // 左上角 X: 45 + 90 * $i
    // 左上角 Y: 280 - $h[$i] + 10  (即 290 - 高度)
    // 右下角 X: 90 + 90 * $i      (即 X + 45 寬度)
    // 右下角 Y: 290
    imagefilledrectangle(
        $im, 
        45 + 90 * $i, 
        280 - $h[$i] + 10, 
        90 + 90 * $i, 
        290, 
        $red
    );

    // 額外加上數值標示（選配，方便查看結果）
    imagestring($im, 2, 55 + 90 * $i, 295, (string)$data[$i], $black);
}

// 7. 輸出與銷毀
imagepng($im);
imagedestroy($im);
?>
