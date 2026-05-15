-- Database structure for EKSPOGRAD
-- Упрощенная версия без проблем с правами доступа (исправление ошибки #1044)

CREATE DATABASE IF NOT EXISTS ekspograd DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ekspograd;

-- Events table
DROP TABLE IF EXISTS events;
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    location VARCHAR(255),
    capacity INT,
    image_url VARCHAR(255),
    price DECIMAL(10,2),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Sample events
INSERT INTO events (name, description, start_date, end_date, location, capacity, image_url, price, is_active) VALUES
('Tech Expo 2026', 'Выставка новейших технологий и инноваций', '2026-05-10 09:00:00', '2026-05-12 18:00:00', 'Зал А, 5000 кв.м', 2000, 'images/tech-expo.jpg', 500.00, 1),
('Business Conference', 'Международная конференция по развитию бизнеса', '2026-05-20 08:30:00', '2026-05-21 17:00:00', 'Конференц-зал, 1000 кв.м', 500, 'images/business-conf.jpg', 3000.00, 1),
('Design Festival', 'Фестиваль дизайна и креативных идей', '2026-06-05 10:00:00', '2026-06-07 19:00:00', 'Зал Б, 3000 кв.м', 1500, 'images/design-fest.jpg', 400.00, 1),
('Art Expo', 'Выставка современного искусства', '2026-06-15 11:00:00', '2026-06-20 20:00:00', 'Галерея, 2000 кв.м', 800, 'images/art-expo.jpg', 250.00, 1),
('Science Symposium', 'Научный форум с участием ведущих ученых', '2026-07-01 09:00:00', '2026-07-03 17:00:00', 'Аудитория, 1500 кв.м', 600, 'images/science-symp.jpg', 1500.00, 1),
('CyberSecurity Summit', 'Саммит по безопасности в интернете', '2026-07-15 08:00:00', '2026-07-16 18:00:00', 'Конференц-зал, 1000 кв.м', 400, 'images/cyber-summit.jpg', 2500.00, 1);

-- Contacts table (заявки и обращения)
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Admin users table
DROP TABLE IF EXISTS admin_users;
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Default admin user (password: admin123)
INSERT INTO admin_users (username, password, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ekspograd.com');

-- Settings table
DROP TABLE IF EXISTS settings;
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    INDEX idx_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Default settings
INSERT INTO settings (setting_key, setting_value) VALUES
('company_phone', '+7 (999) 876-54-32'),
('company_email', 'info@ekspograd.com'),
('company_address', 'Центр выставок и конференций, Центральная улица, д.1'),
('working_hours', 'Пн-Пт 09:00 - 18:00'),
('total_area', '25000'),
('founded_year', '2016');

-- Gallery table
DROP TABLE IF EXISTS gallery;
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255) NOT NULL,
    event_id INT,
    is_published TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;
