<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-about">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>О компании</h1>
            <p>Создаем пространство для великих достижений</p>
        </div>
    </section>

    <section class="container content-section">
        <div class="text-center">
            <h2 class="section-title">Кто мы такие?</h2>
            <p style="max-width: 800px; margin: 0 auto 40px; font-size: 1.1rem; color: #64748b;">
                ЭКСПОГРАД — это современный выставочный комплекс, объединяющий передовые технологии организации мероприятий и премиальный сервис. Мы создаем идеальные условия для взаимодействия бизнеса, науки и искусства.
            </p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-num">10+</div>
                <p>Лет опыта</p>
            </div>
            <div class="stat-card">
                <div class="stat-num">500+</div>
                <p>Счастливых клиентов</p>
            </div>
            <div class="stat-card">
                <div class="stat-num">100%</div>
                <p>Качество сервиса</p>
            </div>
        </div>

        <div class="content-section text-center" style="margin-top: 60px;">
            <h2 class="section-title">Наши ценности</h2>
            <div class="event-cards">
                <div class="card">
                    <div class="card-body">
                        <h3>Инновации</h3>
                        <p>Используем новейшие технологии для управления потоками посетителей и организации пространства.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3>Профессионализм</h3>
                        <p>Наша команда экспертов сопровождает вас на каждом этапе подготовки события.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h3>Масштаб</h3>
                        <p>Возможность реализовать проект любого размера — от камерного семинара до мирового форума.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
