<?php

class Recorder
{
    private string $filePath;

    public function __construct(?string $fileName = LOG_FILE)
    {
        $this->filePath = LOGS_DIR . $fileName;
    }

    public function main(string $message, string $type,)
    {
        $message = $this->generateMessage($message, $type);
        if (!$this->writeLogs($message)) {
            throw new Exception("Something went wrong during recording!" . PHP_EOL);
        }
    }

    public function writeLogs(string $message): false | int  {
        return file_put_contents($this->filePath, $message, FILE_APPEND);
    }

    private function generateMessage(string $message, string $type): string
    {
        $date = date("d/m/Y H:i:s");
        $this->replaceTilda($type);
        $this->replaceTilda($message);
        return "~ [$type] [$date] [$message]" . PHP_EOL;
    }

    private function replaceTilda(string &$str): void
    {
        if (str_contains('~', $str)) {
            $str = str_replace('~', '∼', $str);
        }
    }

}