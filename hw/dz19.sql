-- Створення таблиці "Продукти"
CREATE TABLE IF NOT EXISTS `products` (
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `category` VARCHAR(255),
    `availability` BOOLEAN
);

-- Вставка даних до таблиці "Продукти"
INSERT INTO `products` (`name`, `price`, `category`, `availability`)
VALUES
    ('Ноутбук', 1200.00, 'Електроніка', true),
    ('Смартфон', 800.00, 'Електроніка', true),
    ('Футболка', 20.00, 'Одяг', true),
    ('Джинси', 50.00, 'Одяг', false),
    ('Книга', 30.00, 'Книги', true);

-- Створення таблиці "Замовлення"
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `product_id` INT UNSIGNED,
    `quantity` INT,
    `customer_name` VARCHAR(255),
    `shipping_address` VARCHAR(255),
    `status` VARCHAR(50)
);

-- Вставка даних до таблиці "Замовлення"
INSERT INTO `orders` (`product_id`, `quantity`, `customer_name`, `shipping_address`, `status`)
VALUES
    (1, 2, 'Іванов Іван', 'вул. Шевченка, 10', 'нове'),
    (3, 3, 'Петров Петро', 'вул. Пушкіна, 15', 'в обробці'),
    (2, 1, 'Марина Сидорова', 'вул. Лесі Українки, 5', 'відправлено');

-- Створення таблиці "Користувачі"
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL
);

-- Вставка даних до таблиці "Користувачі"
INSERT INTO `users` (`username`, `email`, `password`)
VALUES
    ('user1', 'user1@example.com', 'password1'),
    ('user2', 'user2@example.com', 'password2'),
    ('user3', 'user3@example.com', 'password3');

-- SELECT-запит для отримання інформації про всі продукти
SELECT * FROM `products`;

-- INSERT-запит для додавання нового продукту
INSERT INTO `products` (`name`, `price`, `category`, `availability`)
VALUES ('Годинник', 150.00, 'Аксесуари', true);

-- UPDATE-запит для оновлення ціни конкретного продукту
UPDATE `products` SET `price` = 160.00 WHERE `id` = 1;

-- DELETE-запит для видалення продукту з бази даних
DELETE FROM `products` WHERE `id` = 5;

-- SELECT-запит для отримання інформації про замовлення з певним статусом
SELECT * FROM `orders` WHERE `status` = 'нове';

-- INSERT-запит для додавання нового замовлення
INSERT INTO `orders` (`product_id`, `quantity`, `customer_name`, `shipping_address`, `status`)
VALUES (3, 2, 'Олег Петренко', 'вул. Івана Франка, 20', 'нове');

-- UPDATE-запит для оновлення статусу певного замовлення
UPDATE `orders` SET `status` = 'відправлено' WHERE `id` = 2;

-- DELETE-запит для видалення замовлення з бази даних
DELETE FROM `orders` WHERE `id` = 3;
