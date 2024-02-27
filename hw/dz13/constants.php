<?php

define('UTILS_DIR', __DIR__ . '/utils/');
define('CLASSES_DIR', __DIR__ . '/classes/');
define('ENUMS_DIR', __DIR__ . '/enums/');
define('TODO_LIST_DIR', __DIR__ . '/todolist/');

const COMMANDS = "List of commands: 
 - files (Показує список всіх файлів); 
 - read <string fileName> (Показує всі таски);
 - record <string fileName> '<string text>' <int priority> (Додає таску);
 - done <string fileName> <int id> (Міняє статус на 'виконано');
 - remove <string fileName> <int id> (Видаляє таску);
 - exit (Вихід із програми);
 - help (Меню).";
