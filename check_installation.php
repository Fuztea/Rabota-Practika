<?php
/**
 * СКРИПТ УСТАНОВКИ И ПРОВЕРКИ
 * 
 * Откройте в браузере: http://localhost/~kirilko/check_installation.php
 * Этот скрипт проверит установку и покажет статус системы
 */

session_start();
require_once 'db_config.php';
require_once 'includes/auth.php';

$status = [];
$errors = [];

// 1. Проверка PHPVersion
$status['php_version'] = [
    'name' => 'PHP версия',
    'value' => phpversion(),
    'ok' => version_compare(phpversion(), '7.4', '>='),
    'required' => '≥ 7.4'
];

// 2. Проверка расширений
$extensions = ['pdo', 'pdo_mysql'];
foreach ($extensions as $ext) {
    $status['ext_' . $ext] = [
        'name' => 'Расширение: ' . strtoupper($ext),
        'value' => extension_loaded($ext) ? 'Загружено' : 'НЕ загружено',
        'ok' => extension_loaded($ext),
        'required' => 'Требуется'
    ];
}

// 3. Проверка сессий
$status['sessions'] = [
    'name' => 'Сессии PHP',
    'value' => ini_get('session.save_handler'),
    'ok' => true,
    'required' => 'Требуется'
];

// 4. Проверка соединения с БД
try {
    $result = $pdo->query("SELECT COUNT(*) FROM users");
    $userCount = $result->fetchColumn();
    $status['database'] = [
        'name' => 'Соединение с БД',
        'value' => "Подключено ✓ (пользователей: $userCount)",
        'ok' => true,
        'required' => 'Требуется'
    ];
} catch (Exception $e) {
    $status['database'] = [
        'name' => 'Соединение с БД',
        'value' => 'ОШИБКА: ' . $e->getMessage(),
        'ok' => false,
        'required' => 'Требуется'
    ];
    $errors[] = 'Не удалось подключиться к БД. Импортируйте database.sql';
}

// 5. Проверка таблицы users
try {
    $pdo->query("DESC users");
    $status['users_table'] = [
        'name' => 'Таблица users',
        'value' => 'Существует ✓',
        'ok' => true,
        'required' => 'Требуется'
    ];
} catch (Exception $e) {
    $status['users_table'] = [
        'name' => 'Таблица users',
        'value' => 'НЕ НАЙДЕНА ✗',
        'ok' => false,
        'required' => 'Требуется'
    ];
    $errors[] = 'Таблица users не создана. Импортируйте database.sql';
}

// 6. Проверка файлов
$files = [
    'register.php' => 'Страница регистрации',
    'login.php' => 'Страница входа',
    'logout.php' => 'Страница выхода',
    'includes/auth.php' => 'Функции аутентификации',
    'includes/header.php' => 'Обновленный header',
];

foreach ($files as $file => $desc) {
    $exists = file_exists(__DIR__ . '/' . $file);
    $status['file_' . str_replace(['/', '.'], ['_', '_'], $file)] = [
        'name' => "Файл: $file",
        'value' => $exists ? 'Существует ✓' : 'НЕ НАЙДЕН ✗',
        'ok' => $exists,
        'required' => 'Требуется'
    ];
    if (!$exists) {
        $errors[] = "Файл $file не найден";
    }
}

// 7. Проверка авторизации
$isLoggedIn = isUserLoggedIn();
$currentUser = $isLoggedIn ? getCurrentUser() : null;
$status['auth_status'] = [
    'name' => 'Статус авторизации',
    'value' => $isLoggedIn ? "Авторизован ✓ (User: {$currentUser['email']})" : "Не авторизован",
    'ok' => true,
    'required' => 'Информация'
];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка установки - ЭКСПОГРАД</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 32px;
        }
        .status-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .status-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border-left: 4px solid #ddd;
        }
        .status-card.ok {
            border-left-color: #4CAF50;
            background: #f8fdf6;
        }
        .status-card.error {
            border-left-color: #f44336;
            background: #fdf6f6;
        }
        .status-card.info {
            border-left-color: #2196F3;
            background: #f6f9fd;
        }
        .status-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .status-value {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-ok {
            background: #4CAF50;
            color: white;
        }
        .badge-error {
            background: #f44336;
            color: white;
        }
        .badge-info {
            background: #2196F3;
            color: white;
        }
        .errors {
            background: #fee;
            border-left: 4px solid #f44336;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 40px;
            color: #c00;
        }
        .errors h3 {
            margin-bottom: 12px;
            font-size: 18px;
        }
        .errors ul {
            list-style: none;
            padding-left: 0;
        }
        .errors li {
            padding: 8px 0;
            border-bottom: 1px solid #fcc;
        }
        .errors li:last-child {
            border-bottom: none;
        }
        .errors li:before {
            content: "❌ ";
            margin-right: 8px;
        }
        .success {
            background: #efe;
            border-left: 4px solid #4CAF50;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 40px;
            color: #0c0;
        }
        .success h3 {
            margin-bottom: 12px;
            font-size: 18px;
        }
        .success:before {
            content: "✅ ";
            margin-right: 8px;
        }
        .links {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .links a {
            display: inline-block;
            padding: 12px 24px;
            margin: 8px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .links a:hover {
            background: #764ba2;
        }
        footer {
            text-align: center;
            color: white;
            margin-top: 40px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Проверка установки ЭКСПОГРАД</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <h3>⚠️ Найдены ошибки:</h3>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <p style="margin-top: 12px; font-size: 13px;">
                    <strong>Решение:</strong> Импортируйте файл database.sql через phpMyAdmin или консоль
                </p>
            </div>
        <?php else: ?>
            <div class="success">
                <h3>Все системы готовы! Вы можете начать использование.</h3>
            </div>
        <?php endif; ?>
        
        <div class="status-grid">
            <?php foreach ($status as $key => $item): 
                $classOk = $item['ok'] ? 'ok' : 'error';
                if ($item['required'] === 'Информация') {
                    $classOk = 'info';
                }
            ?>
                <div class="status-card <?= $classOk ?>">
                    <div class="status-name"><?= htmlspecialchars($item['name']) ?></div>
                    <div class="status-value"><?= htmlspecialchars($item['value']) ?></div>
                    <span class="status-badge badge-<?= $classOk ?>">
                        <?= $item['ok'] ? '✓ OK' : '✗ ERROR' ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="links">
            <h3 style="margin-bottom: 16px; color: #333;">Ссылки для тестирования:</h3>
            <a href="index.php">🏠 На главную</a>
            <a href="register.php">📝 Регистрация</a>
            <a href="login.php">🔑 Вход</a>
            <a href="phpmyadmin/">📊 phpMyAdmin</a>
        </div>
        
        <footer>
            <p>ЭКСПОГРАД — Система управления выставками и конференциями</p>
            <p>Проверка установки №1 | Дата: <?= date('d.m.Y H:i:s') ?></p>
        </footer>
    </div>
</body>
</html>
