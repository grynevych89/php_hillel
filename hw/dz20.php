<?php
// Параметри підключення до бази даних
$servername = "localhost";
$username = "username"; // ваше ім'я користувача бази даних
$password = "password"; // ваш пароль до бази даних
$dbname = "database"; // назва вашої бази даних

// Підключення до бази даних
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка підключення
if ($conn->connect_error) {
    die("Помилка підключення до бази даних: " . $conn->connect_error);
}

// SELECT-запит для отримання інформації про всі продукти
$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Виведення даних про продукти
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Назва: " . $row["name"] . " - Ціна: " . $row["price"] . "<br>";
    }
} else {
    echo "У базі даних немає продуктів";
}

// INSERT-запит для додавання нового продукту
$sql = "INSERT INTO `products` (`name`, `price`, `category`, `availability`)
VALUES ('Годинник', 150.00, 'Аксесуари', true)";

if ($conn->query($sql) === TRUE) {
    echo "Новий продукт успішно доданий";
} else {
    echo "Помилка при додаванні нового продукту: " . $conn->error;
}

// UPDATE-запит для оновлення ціни конкретного продукту
$sql = "UPDATE `products` SET `price` = 160.00 WHERE `id` = 1";

if ($conn->query($sql) === TRUE) {
    echo "Ціна продукту оновлена";
} else {
    echo "Помилка при оновленні ціни продукту: " . $conn->error;
}

// DELETE-запит для видалення продукту з бази даних
$sql = "DELETE FROM `products` WHERE `id` = 5";

if ($conn->query($sql) === TRUE) {
    echo "Продукт успішно видалений";
} else {
    echo "Помилка при видаленні продукту: " . $conn->error;
}

// Закриття з'єднання з базою даних
$conn->close();
