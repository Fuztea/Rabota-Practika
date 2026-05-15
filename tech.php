<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Техническая помощь - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-tech">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Техническая помощь</h1>
            <p>Решим любые технические вопросы быстро и профессионально</p>
        </div>
    </section>

    <section class="container content-section">
        <h2 class="section-title text-center">Что мы решаем</h2>

        <div class="tech-grid">
            <div class="tech-card">
                <span class="tech-num">01</span>
                <h3>Проблемы с билетами</h3>
                <p>Не пришёл электронный билет, ошибка при оплате, QR-код не сканируется — разберёмся в течение 30 минут.</p>
                <a href="mailto:tech@expograd.ru" class="card-link">Написать →</a>
            </div>
            <div class="tech-card">
                <span class="tech-num">02</span>
                <h3>Аудио и видеооборудование</h3>
                <p>Настройка, аренда и оперативный ремонт проекторов, микрофонов, экранов и систем звука для вашего мероприятия.</p>
                <a href="tel:+74950000000" class="card-link">Позвонить →</a>
            </div>
            <div class="tech-card">
                <span class="tech-num">03</span>
                <h3>Интернет и Wi-Fi</h3>
                <p>Подключение к корпоративной сети, настройка высокоскоростного Wi-Fi для участников, решение проблем с доступом.</p>
                <a href="mailto:tech@expograd.ru" class="card-link">Написать →</a>
            </div>
            <div class="tech-card">
                <span class="tech-num">04</span>
                <h3>Электричество и освещение</h3>
                <p>Подключение дополнительного оборудования, настройка освещения залов, аварийные ситуации — дежурный инженер на связи 24/7.</p>
                <a href="tel:+79991234567" class="card-link">Позвонить →</a>
            </div>
            <div class="tech-card">
                <span class="tech-num">05</span>
                <h3>Сайт и личный кабинет</h3>
                <p>Не можете войти в аккаунт, не работает форма регистрации, ошибка на сайте — наша IT-служба устранит проблему.</p>
                <a href="mailto:it@expograd.ru" class="card-link">Написать →</a>
            </div>
            <div class="tech-card">
                <span class="tech-num">06</span>
                <h3>Экстренная поддержка</h3>
                <p>Для срочных ситуаций во время мероприятия — звоните на горячую линию технической службы, доступную круглосуточно.</p>
                <a href="tel:+74950000000" class="card-link">+7 (495) 000-00-00 →</a>
            </div>
        </div>

        <div class="help-cta">
            <p>Нужна срочная помощь прямо сейчас?</p>
            <a href="phone.php" class="btn-main">Заказать звонок</a>
            <a href="support.php" class="btn-secondary-dark">Написать в поддержку</a>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
