<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Помощь - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garant:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-help">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Помощь</h1>
            <p>Всё, что нужно знать для комфортного посещения мероприятий</p>
        </div>
    </section>

    <section class="container content-section">
        <div class="help-grid">

            <div class="help-card">
                <div class="help-icon">🎟️</div>
                <h3>Билеты и регистрация</h3>
                <p>Купить билет можно онлайн на странице афиши или в кассах комплекса. Электронный билет принимается наравне с бумажным — просто покажите QR-код на входе.</p>
            </div>

            <div class="help-card">
                <div class="help-icon">🚗</div>
                <h3>Парковка</h3>
                <p>На территории комплекса расположена бесплатная парковка на 500 мест. Въезд с ул. Выставочной. Для участников мероприятий первые 3 часа — бесплатно.</p>
            </div>

            <div class="help-card">
                <div class="help-icon">♿</div>
                <h3>Доступная среда</h3>
                <p>Все залы оборудованы пандусами, лифтами и специальными местами. Для посетителей с ограниченными возможностями доступна бесплатная помощь сотрудников.</p>
            </div>

            <div class="help-card">
                <div class="help-icon">🍽️</div>
                <h3>Питание</h3>
                <p>На территории работают 3 кафе и ресторан. Приносить еду и напитки с собой разрешено в зоны отдыха. В выставочных залах еда и напитки запрещены.</p>
            </div>

            <div class="help-card">
                <div class="help-icon">📸</div>
                <h3>Фото и видеосъёмка</h3>
                <p>Съёмка для личных целей разрешена на большинстве мероприятий. Коммерческая съёмка требует отдельного согласования с организаторами события.</p>
            </div>

            <div class="help-card">
                <div class="help-icon">🔒</div>
                <h3>Хранение вещей</h3>
                <p>В фойе работает бесплатная гардеробная. Камеры хранения для крупного багажа расположены у входов А и Б, стоимость — 150 руб./день.</p>
            </div>

        </div>

        <div class="help-cta">
            <p>Не нашли ответ на свой вопрос?</p>
            <a href="phone.php" class="btn-main">Заказать звонок</a>
            <a href="contacts.php" class="btn-secondary-dark">Написать нам</a>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
