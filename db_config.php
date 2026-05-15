<?php
$host = 'localhost';  // Попробуйте локальное подключение
$dbname = 'ekspograd';
$username = 'root';
$password = '';
$port = 3306;

try {
    // Используем utf8mb4 для лучшей совместимости
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Более подробная информация об ошибке
    if (strpos($e->getMessage(), '1049') !== false) {
        die("<div style='padding: 20px; background: #fee; color: #c00; border-radius: 5px; margin: 20px;'>
            <h2>⚠️ База данных не найдена</h2>
            <p>База данных '<strong>ekspograd</strong>' не существует.</p>
            <p><strong>Решение:</strong></p>
            <p>1) Откройте phpMyAdmin и импортируйте database.sql</p>
            <p>2) Или выполните в консоли: <code>mysql -u root < database.sql</code></p>
            <p>После создания БД обновите страницу.</p>
        </div>");
    } elseif (strpos($e->getMessage(), '1044') !== false) {
        die("<div style='padding: 20px; background: #fee; color: #c00; border-radius: 5px; margin: 20px;'>
            <h2>⚠️ Ошибка доступа к БД (Error 1044)</h2>
            <p>Пользователь root не имеет доступа к базе данных.</p>
            <p><strong>Решение:</strong> Переимпортируйте упрощённный файл database.sql</p>
            <p>Он был обновлен без конфликтующих команд.</p>
        </div>");
    } else {
        die("<div style='padding: 20px; background: #fee; color: #c00; border-radius: 5px; margin: 20px;'>
            <h2>Ошибка подключения к БД</h2>
            <p><strong>Ошибка:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
            <p><strong>Проверьте:</strong> Хост ($host), БД ($dbname), Пользователь ($username)</p>
        </div>");
    }
}
?>
