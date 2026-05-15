<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-contacts">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Связаться с нами</h1>
            <p>Мы всегда рады ответить на ваши вопросы</p>
        </div>
    </section>

    <section class="container content-section">
        <div class="text-center">
            <h2 class="section-title">Наши координаты</h2>
            <div class="contact-info-grid">
                <div class="info-card">
                    <h3>Адрес</h3>
                    <p>г. Москва, ул. Выставочная, 12<br>Бизнес-центр «Экспо-Сити»</p>
                </div>
                <div class="info-card">
                    <h3>Телефон</h3>
                    <p>+7 (999) 123-45-67<br>+7 (495) 000-00-00</p>
                </div>
                <div class="info-card">
                    <h3>Email</h3>
                    <p>info@expograd.ru<br>sales@expograd.ru</p>
                </div>
            </div>
        </div>

        <div class="content-section text-center" style="margin-top: 60px;">
            <h2 class="section-title">Режим работы</h2>
            <p style="font-size: 1.2rem;">Пн — Пт: 09:00 — 20:00</p>
            <p style="font-size: 1.2rem;">Сб — Вс: 10:00 — 18:00</p>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
