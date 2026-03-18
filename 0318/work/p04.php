<?php
// 第4題：讀取 graph.csv，繪製長條圖與圓餅圖（Canvas）

$csvFile = __DIR__ . '/graph.csv';
$rows = [];
if (($handle = fopen($csvFile, 'r')) !== false) {
    $header = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) >= 3) {
            $rows[] = [
                'category' => trim($data[0]),
                'revenue' => (int) trim($data[1]),
                'sales' => (int) trim($data[2]),
            ];
        }
    }
    fclose($handle);
}

$maxRevenue = 1;
$maxSales = 1;
$totalRevenue = 0;
foreach ($rows as $row) {
    $maxRevenue = max($maxRevenue, $row['revenue']);
    $maxSales = max($maxSales, $row['sales']);
    $totalRevenue += $row['revenue'];
}

// 讀取完資料後輸出 HTML + JS
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>p04</title></head><body>';
echo '<h2>第4題：長條圖 + 圓餅圖</h2>';

echo '<h3>長條圖：營業額</h3>';
foreach ($rows as $row) {
    $w = round(400 * $row['revenue'] / $maxRevenue);
    echo '<div style="margin:5px 0; font-family: Arial, sans-serif;">';
    echo '<strong>' . htmlspecialchars($row['category']) . '</strong>: ' . $row['revenue'];
    echo '<div style="display:inline-block; vertical-align: middle; margin-left: 8px; background:#4c9; height:18px; width:' . $w . 'px;"></div>';
    echo '</div>';
}

echo '<h3>長條圖：銷售件數</h3>';
foreach ($rows as $row) {
    $w = round(400 * $row['sales'] / $maxSales);
    echo '<div style="margin:5px 0; font-family: Arial, sans-serif;">';
    echo '<strong>' . htmlspecialchars($row['category']) . '</strong>: ' . $row['sales'];
    echo '<div style="display:inline-block; vertical-align: middle; margin-left: 8px; background:#59f; height:18px; width:' . $w . 'px;"></div>';
    echo '</div>';
}

echo '<h3>圓餅圖：營業額占比</h3>';
$labels = [];
$values = [];
$colors = ['#f44336','#4caf50','#2196f3','#ff9800','#9c27b0','#3f51b5','#009688','#795548','#e91e63','#607d8b'];
foreach ($rows as $i => $row) {
    $labels[] = htmlspecialchars($row['category']);
    $values[] = $row['revenue'];
    $pct = round($row['revenue'] / max($totalRevenue, 1) * 100, 1);
    echo '<div style="margin:2px 0; font-family: Arial, sans-serif;">' . htmlspecialchars($row['category']) . '：' . $pct . '% <span style="display:inline-block;width:80px;height:14px;background:' . $colors[$i % count($colors)] . ';"></span></div>';
}

echo '<canvas id="pieCanvas" width="320" height="320" style="border:1px solid #ccc; margin-top:10px;"></canvas>';

echo '<!-- 以下用 JavaScript Canvas 畫圓餅圖 -->';
echo '<script>';
echo 'const labels = ' . json_encode($labels) . ';';
echo 'const values = ' . json_encode($values) . ';';
echo 'const colors = ' . json_encode($colors) . ';';
echo 'const total = values.reduce((a, b) => a + b, 0);';
echo 'const c = document.getElementById("pieCanvas");';
echo 'const ctx = c.getContext("2d");';
echo 'let start = 0;';
echo 'for (let i = 0; i < values.length; i++) {';
echo '  const slice = values[i] / total * Math.PI * 2;';
echo '  ctx.beginPath();';
echo '  ctx.moveTo(160, 160);';
echo '  ctx.arc(160, 160, 140, start, start + slice);';
echo '  ctx.closePath();';
echo '  ctx.fillStyle = colors[i % colors.length];';
echo '  ctx.fill();';
echo '  start += slice;';
echo '}';

echo 'ctx.fillStyle = "#ffffff";';
echo 'ctx.beginPath();';
echo 'ctx.arc(160, 160, 50, 0, Math.PI * 2);';
echo 'ctx.fill();';
echo '</script>';

echo '<p><strong>總營業額：</strong>' . $totalRevenue . '</p>';

echo '</body></html>';
