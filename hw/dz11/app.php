<?php

require_once SERVICES_DIR . 'index.php';

class App
{
    private object $reader;
    private object $recorder;

    public function __construct(object $reader, object $recorder)
    {
        $this->reader = $reader;
        $this->recorder = $recorder;
    }
    public function read(): string
    {
        echo "Оберіть # строки, як треба вивести: ";
        $number = (int)fgets(STDIN);
        return $this->reader->main($number);
    }

    public function write(): void
    {
        echo "Введіть повідомлення: ";
        $message = trim(fgets(STDIN));
        echo "Введіть тип повідомлення: ";
        $type = trim(fgets(STDIN));
        $this->recorder->main($message, $type);
    }
}
