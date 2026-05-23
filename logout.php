<?php
session_start();
require_once 'db_config.php';
require_once 'includes/auth.php';

// Выход из системы
logoutUser();

// Перенаправляем на главную страницу
header('Location: index.php');
exit;
?>
