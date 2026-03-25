<?php
// 1. 設定標頭
header("Content-Type: image/png");

// 2. 建立 200x200 的畫布
$width = 400;
$height = 400;
$image = imagecreatetruecolor($width, $height);

// 3. 配置顏色 (第一個分配的顏色通常會自動成為背景色)
$white = imagecolorallocate($image, 255, 255, 255);
$green = imagecolorallocate($image, 0, 255, 0);
$blue = imagecolorallocate($image, 0, 0, 255);
$red = imagecolorallocate($image, 255, 0, 0);
$lightgray = imagecolorallocate($image, 211, 211, 211);
$black = imagecolorallocate($image, 0, 0, 0);

// 4. 填滿背景
imagefill($image, 0, 0, $white);

// 5. 繪製圓形 (圓心 X, 圓心 Y, 寬, 高, 顏色)
imageellipse($image, 200, 200, 300, 300, $green);
imagefilledellipse($image, 200, 200, 250, 250, $blue);
imagefilledellipse($image, 200, 200, 200, 200, $red);
imagefilledellipse($image, 200, 200, 150, 150, $lightgray);
imagefilledellipse($image, 200, 200, 50, 50, $black);
imagefilledellipse($image, 200, 150, 50, 50, $black);
imagefilledellipse($image, 150, 200, 50, 50, $black);
imagefilledellipse($image, 250, 200, 50, 50, $black);
imagefilledellipse($image, 200, 250, 50, 50, $black);


// 6. 輸出並銷毀
imagepng($image);
imagedestroy($image);

?>