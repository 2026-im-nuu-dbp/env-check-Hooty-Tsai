<?php
// register.php - 處理註冊表單
header('Content-Type: text/html; charset=utf-8');

// 檢查是否為POST請求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: 0325from.html');
    exit;
}

// 數據驗證和清理
$errors = [];
$data = [];

// 姓名
if (empty($_POST['name'])) {
    $errors[] = '請輸入姓名';
} else {
    $data['name'] = htmlspecialchars($_POST['name']);
}

// 性別
if (empty($_POST['gender'])) {
    $errors[] = '請選擇性別';
} else {
    $data['gender'] = $_POST['gender'];
}

// 出生年月日
if (empty($_POST['birthdate'])) {
    $errors[] = '請選擇出生年月日';
} else {
    $data['birthdate'] = $_POST['birthdate'];
}

// 行動裝置
$devices = isset($_POST['devices']) ? $_POST['devices'] : [];
if (is_array($devices)) {
    $devices = array_map('htmlspecialchars', $devices);
    $data['devices'] = $devices;
} else {
    $data['devices'] = array();
}

// Email
if (empty($_POST['email'])) {
    $errors[] = '請輸入E-mail信箱';
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'E-mail格式不正確';
} else {
    $data['email'] = htmlspecialchars($_POST['email']);
}

// 電話
if (empty($_POST['phone'])) {
    $errors[] = '請輸入電話';
} else {
    $data['phone'] = htmlspecialchars($_POST['phone']);
}

// 職業
if (empty($_POST['occupation'])) {
    $errors[] = '請選擇職業';
} else {
    $data['occupation'] = htmlspecialchars($_POST['occupation']);
}

// 密碼
if (empty($_POST['password'])) {
    $errors[] = '請輸入密碼';
} elseif (strlen($_POST['password']) < 8) {
    $errors[] = '密碼長度至少8個字符';
} else {
    $data['password'] = $_POST['password'];
}

// 密碼確認
if (empty($_POST['confirm_password'])) {
    $errors[] = '請確認密碼';
} elseif ($_POST['password'] !== $_POST['confirm_password']) {
    $errors[] = '密碼與確認密碼不符';
} else {
    $data['confirm_password'] = $_POST['confirm_password'];
}

// 職業對照表
$occupation_names = array(
    'student' => '學生',
    'it' => '資訊科技',
    'finance' => '金融',
    'education' => '教育',
    'healthcare' => '醫療保健',
    'retail' => '零售',
    'manufacturing' => '製造',
    'government' => '政府機構',
    'other' => '其他'
);

$gender_names = array(
    'male' => '男',
    'female' => '女',
    'other' => '其他'
);

$device_names = array(
    'ios' => 'iOS (iPhone)',
    'android' => 'Android',
    'tablet' => '平板電腦'
);
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊結果</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Microsoft JhengHei', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
        }
        
        .result-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .result-header {
            padding: 40px 30px;
            text-align: center;
        }
        
        .success-icon {
            font-size: 60px;
            margin-bottom: 15px;
            animation: scaleIn 0.5s ease-out;
        }
        
        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
        
        .result-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 8px;
        }
        
        .result-header p {
            color: #666;
            font-size: 14px;
        }
        
        .success-box {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 18px;
            margin-bottom: 30px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
        }
        
        .error-box {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        
        .error-box strong {
            display: block;
            margin-bottom: 10px;
        }
        
        .error-box ul {
            list-style: none;
            padding-left: 0;
        }
        
        .error-box li {
            padding: 6px 0;
        }
        
        .error-box li:before {
            content: "⚠ ";
            margin-right: 8px;
        }
        
        .result-body {
            padding: 0 30px 30px;
        }
        
        .info-row {
            display: flex;
            padding: 14px;
            background: #f8fafc;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
        }
        
        .info-label {
            font-weight: 600;
            color: #667eea;
            min-width: 80px;
        }
        
        .info-value {
            color: #333;
            flex: 1;
        }
        
        .result-footer {
            padding: 20px 30px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .back-btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="result-card">
            <div class="result-header">
                <?php if (empty($errors)): ?>
                    <div class="success-icon">✓</div>
                    <h1>註冊成功！</h1>
                    <p>歡迎加入我們的會員</p>
                <?php else: ?>
                    <h1>請檢查輸入</h1>
                    <p>註冊過程中發生錯誤</p>
                <?php endif; ?>
            </div>
            
            <div class="result-body">
                <?php if (!empty($errors)): ?>
                    <div class="error-box">
                        <strong>發生錯誤</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="success-box">
                        您的註冊資訊已成功提交
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">姓名</div>
                        <div class="info-value"><?php echo $data['name']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">性別</div>
                        <div class="info-value"><?php echo isset($gender_names[$data['gender']]) ? $gender_names[$data['gender']] : $data['gender']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">出生年月日</div>
                        <div class="info-value"><?php echo $data['birthdate']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">行動裝置</div>
                        <div class="info-value">
                            <?php 
                            if (!empty($data['devices'])) {
                                $selected = array();
                                foreach ($data['devices'] as $device) {
                                    $selected[] = isset($device_names[$device]) ? $device_names[$device] : $device;
                                }
                                echo implode('、', $selected);
                            } else {
                                echo '未選擇';
                            }
                            ?>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">E-mail</div>
                        <div class="info-value"><?php echo $data['email']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">電話</div>
                        <div class="info-value"><?php echo $data['phone']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">職業</div>
                        <div class="info-value"><?php echo isset($occupation_names[$data['occupation']]) ? $occupation_names[$data['occupation']] : $data['occupation']; ?></div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="result-footer">
                <a href="0325from.html" class="back-btn">← 返回表單</a>
            </div>
        </div>
    </div>
</body>
</html>
