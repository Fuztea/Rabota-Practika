<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поддержка - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-support">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Поддержка</h1>
            <p>Мы на связи и готовы помочь в любой ситуации</p>
        </div>
    </section>

    <section class="container content-section">

        <div class="support-channels">
            <div class="channel-card">
                <div class="channel-icon">📞</div>
                <h3>Телефон</h3>
                <p>Горячая линия работает круглосуточно</p>
                <a href="tel:+79991234567" class="channel-link">+7 (999) 123-45-67</a>
            </div>
            <div class="channel-card">
                <div class="channel-icon">✉️</div>
                <h3>Email</h3>
                <p>Ответим в течение 2 рабочих часов</p>
                <a href="mailto:support@expograd.ru" class="channel-link">support@expograd.ru</a>
            </div>
            <div class="channel-card">
                <div class="channel-icon">💬</div>
                <h3>Онлайн-чат</h3>
                <p>Чат работает пн–пт с 09:00 до 20:00</p>
                <a href="#" class="channel-link">Открыть чат</a>
            </div>
        </div>

        <div class="support-form-wrap">
            <h2 class="section-title text-center">Написать в поддержку</h2>
            <div class="form-container">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    require_once 'db_config.php';
                    
                    $name = htmlspecialchars($_POST['name'] ?? '');
                    $email = htmlspecialchars($_POST['email'] ?? '');
                    $subject = htmlspecialchars($_POST['subject'] ?? '');
                    $message = htmlspecialchars($_POST['message'] ?? '');
                    
                    if (!empty($name) && !empty($email) && !empty($message)) {
                        try {
                            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
                            $stmt->execute([$name, $email, $message . ' (Тема: ' . $subject . ')']);
                            echo "<div style='color: green; text-align: center; margin: 20px 0;'>Спасибо! Ваше обращение отправлено. Мы ответим вам в ближайшее время.</div>";
                        } catch (Exception $e) {
                            echo "<div style='color: red; text-align: center; margin: 20px 0;'>Ошибка при отправке обращения. Попробуйте позже.</div>";
                        }
                    }
                }
                ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" id="name" name="name" placeholder="Иван Иванов" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@mail.ru" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Тема обращения</label>
                        <input type="text" id="subject" name="subject" placeholder="Кратко опишите проблему">
                    </div>
                    <div class="form-group">
                        <label for="message">Сообщение</label>
                        <textarea id="message" name="message" rows="5" placeholder="Подробно опишите вашу ситуацию" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Отправить обращение</button>
                </form>
            </div>
        </div>

    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
