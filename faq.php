<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-faq">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Частые вопросы</h1>
            <p>Ответы на самые популярные вопросы наших посетителей</p>
        </div>
    </section>

    <section class="container content-section">
        <h2 class="section-title text-center">FAQ</h2>

        <div class="faq-list">

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Как купить билет на мероприятие?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>Билеты можно приобрести онлайн на странице <a href="events.php">Афиша</a>, нажав кнопку «Купить билет» рядом с нужным событием. Также доступна покупка в кассах комплекса — они работают ежедневно с 09:00 до 20:00.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Можно ли вернуть билет?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>Да. Возврат возможен не позднее чем за 72 часа до начала мероприятия. Для возврата обратитесь на <a href="contacts.php">страницу контактов</a> или позвоните по номеру +7 (999) 123-45-67. Деньги возвращаются в течение 3–5 рабочих дней.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Как арендовать зал для мероприятия?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>Оставьте заявку через форму <a href="phone.php">«Заказать звонок»</a>, и наш менеджер свяжется с вами для обсуждения деталей. Мы предлагаем залы от 50 до 5000 человек с полным техническим оснащением.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Есть ли скидки для групп и корпоративных клиентов?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>Да, мы предоставляем скидки от 10% для групп от 10 человек, а также специальные корпоративные тарифы. Подробности уточняйте по телефону или через форму обратной связи.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Как добраться до комплекса?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>Адрес: г. Москва, ул. Выставочная, 12. Ближайшее метро — «Выставочная» (5 минут пешком). На автомобиле: бесплатная парковка со стороны ул. Выставочной, въезд через ворота А.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Можно ли прийти с детьми?
                    <span class="faq-arrow">▾</span>
                </button>
                <div class="faq-answer">
                    <p>На большинство мероприятий дети до 12 лет проходят бесплатно в сопровождении взрослого. На территории есть пеленальные комнаты и зоны отдыха с детскими уголками.</p>
                </div>
            </div>

        </div>

        <div class="help-cta">
            <p>Нужна помощь?</p>
            <a href="phone.php" class="btn-main">Заказать звонок</a>
            <a href="support.php" class="btn-secondary-dark">Написать в поддержку</a>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

    <script>
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        }
    </script>

</body>
</html>
