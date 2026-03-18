<?php

$arr = ['桂花'=>30, '梅花'=>70, ' 梨花'=>24,
  '茶花'=>134, '桔梗'=>33,      
  '山櫻'=>234, '吉野櫻'=>43];

// 原始順序
echo "原始順序<br>";
foreach ($arr as $key => $value) {
    echo $key . ' => ' . $value . '<br>';
}

echo '<hr>';

// 小到大排序
asort($arr);
echo "asort（小到大）<br>";
foreach ($arr as $key => $value) {
    echo $key . ' => ' . $value . '<br>';
}

echo '<hr>';

// 大到小排序
arsort($arr);
echo "arsort（大到小）<br>";
foreach ($arr as $key => $value) {
    echo $key . ' => ' . $value . '<br>';
}

echo '<hr>';

date_default_timezone_set('Asia/Taipei');

$rocYear = date('Y') - 1911;
$weekday = ['日','一','二','三','四','五','六'][date('w')];
$amPm = date('A') === 'AM' ? '上午' : '下午';

$format1 = sprintf('%d年%d月%d日 星期%s %s%d時%d分', $rocYear, date('n'), date('j'), $weekday, $amPm, date('g'), date('i'));
$format2 = sprintf('%d/%d %d, %02d:%02d', date('n'), date('j'), date('Y'), date('H'), date('i'));
$format3 = sprintf('%s/%s/%s %s. %02d:%02d', date('Y'), date('n'), date('j'), date('D'), date('g'), date('i'));

echo "格式 113年3月12日 星期二 上午10時20分：" . $format1 . '<br>';
echo "格式 3/12 2024, 14:20：" . $format2 . '<br>';
echo "格式 2024/3/12 Tue. 10:30：" . $format3 . '<br>';


echo '<hr>';

$keys = array_keys($arr);

//字串
$astring = implode(', ', $keys);
echo "字串行：$astring<br>";

$carray = explode(', ', $astring);
echo "陣列列：<br>";
foreach ($carray as $value) {
    echo $value . '<br>';
}







?>



