<?php

require __DIR__ . '/traits/Validator.php';
require __DIR__ . '/schemas/validationSchemas.php';
require __DIR__ . '/controllers/UserController.php';
require __DIR__ . '/controllers/AuthController.php';

echo '-----------------------------------------------------------------------' . PHP_EOL;
echo "VALID DATA:" . PHP_EOL;

try {
    $authController = new AuthController;
    $authController->register([
        'email' => 'grynevych89@mail.com',
        'password' => 'Qwerty1234$'
    ]);
    echo "Реєстрація успішна!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}
echo '++++++++++++++++++++++++++++++++++++' . PHP_EOL;
try {
    $authController = new AuthController;
    $authController->register([
        'email' => 'grynevych89@mail.com',
        'password' => 'Qwerty1234$'
    ]);
    echo "Вхід успішний!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}

try {
    $userController = new UserController;
    $userController->update(['name' => 'Mykola']);
    echo "Дані користувача успішно відредаговано!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}

echo '-----------------------------------------------------------------------' . PHP_EOL;
echo '-----------------------------------------------------------------------' . PHP_EOL;
echo '-----------------------------------------------------------------------' . PHP_EOL;
echo "INVALID DATA:" . PHP_EOL;

try {
    $authController = new AuthController;
    $authController->register([
        'email' => 'test',
        'password' => 'test'
    ]);
    echo "Реєстрація успішна!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}

try {
    $authController = new AuthController;
    $authController->register([
        'email' => 'test',
        'password' => 'test'
    ]);
    echo "Вхід успішний!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}

try {
    $userController = new UserController;
    $userController->update(['name' => 1]);
    echo "Дані користувача успішно відредаговано!" . PHP_EOL;
} catch (Exception $error) {
    echo $error->getMessage();
}
