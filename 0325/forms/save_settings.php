<?php
// 處理來自 a4.html 的表單數據

// 檢查是否有POST請求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // 如果不是POST請求，重定向到a4.html
    header('Location: a4.html');
    exit;
}

// 獲取表單數據
$city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
$gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
$hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

// 對hobbies進行清理
$hobbies = array_map('htmlspecialchars', $hobbies);

// 驗證數據
$errors = [];

if (empty($city)) {
    $errors[] = '請選擇城市';
}

if (empty($gender)) {
    $errors[] = '請選擇性別';
}

// 準備顯示數據的映射
$city_names = [
    'taipei' => '台北',
    'taichung' => '台中',
    'kaohsiung' => '高雄'
];

$gender_names = [
    'male' => '男',
    'female' => '女'
];

$hobby_names = [
    'coding' => '寫程式',
    'reading' => '閱讀'
];
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>設定結果</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            max-width: 500px;
            width: 100%;
        }
        
        .card {
            background: white;
            border-radius: 15px;
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
        
        .card-header {
            padding: 40px 30px 20px;
            text-align: center;
        }
        
        .card-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .success-icon {
            font-size: 60px;
            color: #10b981;
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
        
        .success-message {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 30px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
        }
        
        .error-message {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .error-message strong {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .error-message ul {
            list-style: none;
            padding-left: 0;
        }
        
        .error-message li {
            padding: 8px 0;
            display: flex;
            align-items: center;
        }
        
        .error-message li:before {
            content: "⚠ ";
            margin-right: 8px;
        }
        
        .card-body {
            padding: 0 30px 30px;
        }
        
        .info-row {
            display: flex;
            align-items: center;
            padding: 16px;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 12px;
            border-left: 4px solid #667eea;
            transition: all 0.3s ease;
        }
        
        .info-row:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }
        
        .info-label {
            font-weight: 600;
            color: #667eea;
            min-width: 90px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-value {
            color: #333;
            font-size: 16px;
            flex: 1;
        }
        
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .tag {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .card-footer {
            padding: 20px 30px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }
        
        .back-btn:active {
            transform: translateY(0);
        }
        
        .icon {
            width: 24px;
            text-align: center;
        }
        
        @media (max-width: 480px) {
            .card {
                border-radius: 10px;
            }
            
            .card-header {
                padding: 30px 20px 15px;
            }
            
            .card-header h1 {
                font-size: 24px;
            }
            
            .card-body {
                padding: 0 20px 20px;
            }
            
            .card-footer {
                padding: 15px 20px;
            }
            
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-label {
                margin-bottom: 8px;
                width: 100%;
            }
            
            .info-value {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <?php if (empty($errors)): ?>
                    <div class="success-icon">✓</div>
                    <h1>設定成功！</h1>
                <?php else: ?>
                    <h1>請檢查輸入</h1>
                <?php endif; ?>
            </div>
            
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="error-message">
                        <strong>發生錯誤</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="success-message">
                        您的設定資訊已成功儲存
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <span class="icon">🏙️</span> 城市
                        </div>
                        <div class="info-value">
                            <?php echo isset($city_names[$city]) ? $city_names[$city] : $city; ?>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <span class="icon">👤</span> 性別
                        </div>
                        <div class="info-value">
                            <?php echo isset($gender_names[$gender]) ? $gender_names[$gender] : $gender; ?>
                        </div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <span class="icon">⭐</span> 興趣
                        </div>
                        <div class="info-value">
                            <?php 
                            if (!empty($hobbies)) {
                                $selected_hobbies = [];
                                foreach ($hobbies as $hobby) {
                                    if (isset($hobby_names[$hobby])) {
                                        $selected_hobbies[] = $hobby_names[$hobby];
                                    } else {
                                        $selected_hobbies[] = $hobby;
                                    }
                                }
                            ?>
                            <div class="tags">
                                <?php foreach ($selected_hobbies as $hobby): ?>
                                    <span class="tag"><?php echo $hobby; ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php 
                            } else {
                                echo '未選擇';
                            }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="card-footer">
                <a href="a4.html" class="back-btn">
                    <span>←</span> 返回表單
                </a>
            </div>
        </div>
    </div>
</body>
</html>
