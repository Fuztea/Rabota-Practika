<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказать звонок - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-phone">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Заказать звонок</h1>
            <p>Оставьте заявку, и наш менеджер свяжется с вами в ближайшее время</p>
        </div>
    </section>

    <section class="container content-section">
        <div class="form-container">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require_once 'db_config.php';
                
                $name = htmlspecialchars($_POST['name'] ?? '');
                $phone = htmlspecialchars($_POST['phone'] ?? '');
                $message = htmlspecialchars($_POST['message'] ?? '');
                
                if (!empty($name) && !empty($phone)) {
                    try {
                        $stmt = $pdo->prepare("INSERT INTO contacts (name, phone, message) VALUES (?, ?, ?)");
                        $stmt->execute([$name, $phone, $message]);
                        echo "<div style='color: green; text-align: center; margin: 20px 0;'>Спасибо! Ваша заявка принята. Менеджер свяжется с вами в ближайшее время.</div>";
                    } catch (Exception $e) {
                        echo "<div style='color: red; text-align: center; margin: 20px 0;'>Ошибка при отправке заявки. Попробуйте позже.</div>";
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
                    <label for="phone">Номер телефона</label>
                    <input type="tel" id="phone" name="phone" placeholder="+7 (___) ___-__-__" required>
                </div>
                <div class="form-group">
                    <label for="message">Комментарий (необязательно)</label>
                    <textarea id="message" name="message" rows="4" placeholder="Расскажите подробнее о вашем запросе"></textarea>
                </div>
                <button type="submit" class="btn-submit">Отправить заявку</button>
            </form>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
