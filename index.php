<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЭКСПОГРАД - Главная</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-home">

    <?php require_once 'includes/header.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <span class="badge">Бизнес и инновации</span>
            <h1>Масштабные события<br>в центре города</h1>
            <p>Профессиональные площадки для выставок, конференций и презентаций любого уровня.</p>
            <div class="hero-btns">
                <a href="events.php" class="btn-main">Смотреть события</a>
                <a href="about.php" class="btn-secondary">Узнать больше</a>
            </div>
        </div>
    </section>

    <section id="stats" class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-num">25 000+</div>
                <p>Кв. метров площади</p>
            </div>
            <div class="stat-card">
                <div class="stat-num">150</div>
                <p>Форумов ежегодно</p>
            </div>
            <div class="stat-card">
                <div class="stat-num">12</div>
                <p>Конференц-залов</p>
            </div>
        </div>
    </section>

    <section id="events-preview" class="events-section">
        <div class="container">
            <h2 class="section-title">Актуальные выставки</h2>
            <div class="event-cards">
                <div class="card">
                    <div class="card-tag gold">Дизайн</div>
                    <div class="card-body">
                        <h3>Интерьер & Стиль</h3>
                        <p class="date">20 - 22 мая</p>
                        <p>Выставка современного дизайна и архитектурных решений.</p>
                        <a href="events.php" class="card-link">Подробнее →</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-tag green">Эко</div>
                    <div class="card-body">
                        <h3>Green City</h3>
                        <p class="date">01 - 03 июня</p>
                        <p>Международный форум по экологии и устойчивому развитию.</p>
                        <a href="events.php" class="card-link">Подробнее →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
