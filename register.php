<?php
session_start();
require_once 'db_config.php';
require_once 'includes/auth.php';

// Если уже авторизован, перенаправляем на главную
if (isUserLoggedIn()) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = '';

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    
    // Валидация
    if (empty($email) || empty($password) || empty($name)) {
        $error = 'Заполните все обязательные поля (Email, пароль, имя)';
    } elseif ($password !== $password_confirm) {
        $error = 'Пароли не совпадают';
    } else {
        // Попытка регистрации
        $result = registerUser($email, $password, $name, $phone);
        if ($result['success']) {
            $success = $result['message'] . '. Теперь вы можете <a href="login.php">войти в систему</a>';
        } else {
            $error = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .register-section {
            min-height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        .register-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }
        
        .register-container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        
        .form-group span {
            display: block;
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }
        
        .btn-register {
            width: 100%;
            padding: 14px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-register:hover {
            background: #45a049;
        }
        
        .error-message {
            background: #fee;
            color: #c00;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c00;
        }
        
        .success-message {
            background: #efe;
            color: #0c0;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #0c0;
        }
        
        .success-message a {
            color: #0c0;
            font-weight: 600;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        
        .login-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php require_once 'includes/header.php'; ?>
    
    <section class="register-section">
        <div class="register-container">
            <h1>Регистрация</h1>
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="success-message"><?= $success ?></div>
            <?php endif; ?>
            
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="name">Ваше имя *</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" placeholder="+7 (999) 999-99-99">
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль *</label>
                    <input type="password" id="password" name="password" required>
                    <span>Минимум 6 символов</span>
                </div>
                
                <div class="form-group">
                    <label for="password_confirm">Повторите пароль *</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div>
                
                <button type="submit" class="btn-register">Зарегистрироваться</button>
            </form>
            
            <div class="login-link">
                Уже есть аккаунт? <a href="login.php">Войдите в систему</a>
            </div>
        </div>
    </section>
    
    <?php require_once 'includes/footer.php'; ?>
</body>
</html>
