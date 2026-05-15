<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Афиша - ЭКСПОГРАД</title>
    <link rel="stylesheet" href="kirilko1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-events">

    <?php require_once 'includes/header.php'; ?>

    <section class="page-header">
        <div class="container">
            <h1>Афиша событий</h1>
            <p>Будьте в курсе самых масштабных мероприятий</p>
        </div>
    </section>

    <section class="container content-section">
        <h2 class="section-title text-center">Ближайшие события</h2>
        <div class="event-cards">
            <?php
            require_once 'db_config.php';
            try {
                $stmt = $pdo->query("SELECT * FROM events WHERE is_active = 1 ORDER BY start_date ASC");
                $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if (count($events) > 0) {
                    foreach ($events as $event) {
                        $start_date = new DateTime($event['start_date']);
                        $end_date = new DateTime($event['end_date']);
                        $date_range = $start_date->format('d.m') . ' - ' . $end_date->format('d.m');
                        ?>
                        <div class="card">
                            <div class="card-tag gold"><?php echo htmlspecialchars($event['name']); ?></div>
                            <div class="card-body">
                                <h3><?php echo htmlspecialchars($event['name']); ?></h3>
                                <p class="date"><?php echo $date_range; ?></p>
                                <p><?php echo htmlspecialchars(substr($event['description'], 0, 100)) . '...'; ?></p>
                                <a href="#" class="card-link">Купить билет →</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p style='text-align: center; grid-column: 1/-1;'>Нет активных событий</p>";
                }
            } catch (Exception $e) {
                echo "<p style='text-align: center; grid-column: 1/-1;'>Ошибка загрузки событий</p>";
            }
            ?>
        </div>
    </section>

    <?php require_once 'includes/footer.php'; ?>

</body>
</html>
