<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

require_once '../db_config.php';

$message = '';
$tab = $_GET['tab'] ?? 'events';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_event'])) {
        $stmt = $pdo->prepare("INSERT INTO events (name, description, start_date, end_date, location, capacity, image_url, price, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'],
            $_POST['description'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['location'],
            $_POST['capacity'],
            $_POST['image_url'],
            $_POST['price'],
            isset($_POST['is_active']) ? 1 : 0
        ]);
        $message = 'Событие добавлено успешно';
    } elseif (isset($_POST['delete_event'])) {
        $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
        $stmt->execute([$_POST['event_id']]);
        $message = 'Событие удалено';
    } elseif (isset($_POST['activate_event'])) {
        $stmt = $pdo->prepare("UPDATE events SET is_active = NOT is_active WHERE id = ?");
        $stmt->execute([$_POST['event_id']]);
        $message = 'Статус события изменен';
    } elseif (isset($_POST['mark_read'])) {
        $stmt = $pdo->prepare("UPDATE contacts SET is_read = TRUE WHERE id = ?");
        $stmt->execute([$_POST['contact_id']]);
        $message = 'Контакт отмечен как прочитанный';
    } elseif (isset($_POST['delete_contact'])) {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$_POST['contact_id']]);
        $message = 'Контакт удален';
    }
}

$stmt = $pdo->query("SELECT * FROM events ORDER BY start_date DESC");
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель — ЭКСПОГРАД</title>
    <link rel="stylesheet" href="../kirilko1.css">
    <style>
        .admin-container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 20px; }
        .admin-header h1 { margin: 0; color: #1a1a1a; }
        .btn-logout { padding: 10px 20px; background: #c00; color: white; text-decoration: none; border-radius: 5px; font-weight: 600; }
        .btn-logout:hover { background: #a00; }
        .message { padding: 15px; background: #d4edda; color: #155724; margin-bottom: 20px; border-radius: 5px; border-left: 4px solid #28a745; }
        .tabs { display: flex; gap: 10px; margin-bottom: 20px; border-bottom: 2px solid #ddd; }
        .tab-btn { padding: 10px 20px; background: none; border: none; cursor: pointer; font-size: 16px; color: #666; font-weight: 500; border-bottom: 3px solid transparent; margin-bottom: -2px; transition: all 0.3s; }
        .tab-btn.active { color: #2c5aa0; border-bottom-color: #2c5aa0; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .admin-panel { display: grid; grid-template-columns: 300px 1fr; gap: 30px; }
        .add-form { background: #f8f8f8; padding: 20px; border-radius: 5px; }
        .add-form h2 { margin-top: 0; color: #1a1a1a; }
        .add-form input, .add-form select, .add-form textarea { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; font-size: 14px; }
        .add-form button { width: 100%; padding: 10px; background: #2c5aa0; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 600; }
        .add-form button:hover { background: #1e3f73; }
        .list-section { background: #f8f8f8; padding: 20px; border-radius: 5px; }
        .list-section table { width: 100%; border-collapse: collapse; }
        .list-section th, .list-section td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; font-size: 14px; }
        .list-section th { background: #2c5aa0; color: white; font-weight: 600; }
        .btn-action { padding: 5px 10px; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 12px; margin-right: 5px; }
        .btn-edit { background: #007bff; }
        .btn-delete { background: #dc3545; }
        .btn-toggle { background: #ffc107; color: #000; }
        .btn-action:hover { opacity: 0.9; }
        .status-active { color: green; font-weight: 600; }
        .status-inactive { color: red; font-weight: 600; }
        .checkbox-label { display: flex; align-items: center; gap: 10px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Админ-панель ЭКСПОГРАД</h1>
            <a href="login.php" class="btn-logout">Выйти (<?php echo htmlspecialchars($_SESSION['admin_username']); ?>)</a>
        </div>
        
        <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <div class="tabs">
            <button class="tab-btn <?php echo $tab === 'events' ? 'active' : ''; ?>" onclick="switchTab('events')">События</button>
            <button class="tab-btn <?php echo $tab === 'contacts' ? 'active' : ''; ?>" onclick="switchTab('contacts')">Контакты</button>
        </div>

        <!-- Events Tab -->
        <div id="events" class="tab-content <?php echo $tab === 'events' ? 'active' : ''; ?>">
            <div class="admin-panel">
                <div class="add-form">
                    <h2>Добавить событие</h2>
                    <form method="POST">
                        <input type="text" name="name" placeholder="Название события" required>
                        <textarea name="description" placeholder="Описание" rows="3"></textarea>
                        <input type="datetime-local" name="start_date" placeholder="Начало события" required>
                        <input type="datetime-local" name="end_date" placeholder="Конец события" required>
                        <input type="text" name="location" placeholder="Местоположение">
                        <input type="number" name="capacity" placeholder="Вместимость">
                        <input type="text" name="image_url" placeholder="URL изображения">
                        <input type="number" name="price" placeholder="Цена" step="0.01">
                        <div class="checkbox-label">
                            <input type="checkbox" id="is_active" name="is_active" checked>
                            <label for="is_active" style="margin: 0;">Активное</label>
                        </div>
                        <button type="submit" name="add_event">Добавить событие</button>
                    </form>
                </div>

                <div class="list-section">
                    <h2>События</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Название</th>
                                <th>Дата начала</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($events as $event): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($event['name']); ?></td>
                                <td><?php echo substr($event['start_date'], 0, 10); ?></td>
                                <td class="<?php echo $event['is_active'] ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo $event['is_active'] ? 'Активно' : 'Неактивно'; ?>
                                </td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                        <button type="submit" name="activate_event" class="btn-action btn-toggle">Переключить</button>
                                    </form>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                        <button type="submit" name="delete_event" class="btn-action btn-delete" onclick="return confirm('Вы уверены?')">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Contacts Tab -->
        <div id="contacts" class="tab-content <?php echo $tab === 'contacts' ? 'active' : ''; ?>">
            <div class="list-section" style="grid-column: 1/-1;">
                <h2>Заявки и обращения</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Телефон / Email</th>
                            <th>Тема</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contact['name']); ?></td>
                            <td><?php echo htmlspecialchars($contact['phone'] ?? $contact['email'] ?? '-'); ?></td>
                            <td style="max-width: 200px; white-space: normal;"><?php echo htmlspecialchars(substr($contact['message'], 0, 50)) . '...'; ?></td>
                            <td><?php echo substr($contact['created_at'], 0, 10); ?></td>
                            <td class="<?php echo $contact['is_read'] ? 'status-inactive' : 'status-active'; ?>">
                                <?php echo $contact['is_read'] ? 'Прочитано' : 'Новое'; ?>
                            </td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
                                    <button type="submit" name="mark_read" class="btn-action btn-edit">Прочитано</button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
                                    <button type="submit" name="delete_contact" class="btn-action btn-delete" onclick="return confirm('Вы уверены?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
            
            // Update URL
            window.history.replaceState({}, '', '?tab=' + tabName);
        }
    </script>

</body>
</html>
