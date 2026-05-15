<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../db_config.php';
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user && $password === $user['password']) {
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_username'] = $user['username'];
        header('Location: index.php');
        exit;
    } else {
        $error = 'Неверное имя пользователя или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админ-панель — ЭКСПОГРАД</title>
    <link rel="stylesheet" href="../kirilko1.css">
    <style>
        .admin-login { max-width: 400px; margin: 100px auto; padding: 40px; text-align: center; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-login h1 { margin-bottom: 30px; color: #1a1a1a; }
        .admin-login input { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; box-sizing: border-box; }
        .admin-login button { width: 100%; padding: 12px; background: #2c5aa0; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; font-weight: 600; }
        .admin-login button:hover { background: #1e3f73; }
        .error { color: red; margin-bottom: 15px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="admin-login">
        <h1>Вход в админ-панель</h1>
        <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Логин" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
        <p style="margin-top: 20px; font-size: 14px; color: #666;">Логин: admin, Пароль: admin123</p>
    </div>
</body>
</html>
