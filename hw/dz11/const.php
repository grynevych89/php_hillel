<?php

const APP_DIR = __DIR__ . '/';
const SERVICES_DIR = APP_DIR . 'services/';
const LOGS_DIR = APP_DIR . 'logs/';
const LOG_FILE = 'logs.txt';

const COMMANDS = "List of commands: 
 - read (Читає файл та повертає записи);
 - write (Записує логи);
 - quit (Закрити програму);
 - help (Підказка по командам)." . PHP_EOL;
