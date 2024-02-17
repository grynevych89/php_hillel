<?php

class Reader
{
    private string $filePath;
    private $file;
    private string $lines;
    private int $linesQuantity;
    private int $lineCounter;

    public function __construct(?string $fileName = LOG_FILE)
    {
        $this->filePath = LOGS_DIR . $fileName;
        $this->lines = '';
        $this->linesQuantity = 1;
        $this->lineCounter = 0;
    }

    /**
     * @throws Exception
     */
    public function main(int $linesQuantity): string
    {
        $this->resetLines();
        $this->resetLineCounter();
        $this->setFile();
        $this->setLinesQuantity($linesQuantity);
        $this->setLines();
        return $this->getLines();
    }

    public function getLines(): string
    {
        return $this->lines;
    }

    private function setLines(): void
    {
        fseek($this->file, 0, SEEK_END);

        $pointer = 0;
        while (true) {
            if (!ftell($this->file) || $this->lineCounter >= $this->linesQuantity) {
                break;
            }

            $char = fread($this->file, 1);

            if ($char === '~') {
                $this->lines .= trim(fgets($this->file)) .PHP_EOL;
                $this->incrementLineCounter();
            }

            fseek($this->file, $pointer, SEEK_END);
            $pointer--;
        }
    }

    private function resetLines(): void
    {
        $this->lines = '';
    }


    private function setLinesQuantity(int $linesQuantity): void
    {
        if ($linesQuantity <= 0) {
            $linesQuantity = 1;
        }

        $this->linesQuantity = $linesQuantity;
    }

    private function setFile(): void
    {
        if ($this->file) {
            return;
        }

        if (!is_readable($this->filePath)) {
            throw new Exception("File with name $this->filePath not found!" . PHP_EOL);
        }

        $file = fopen($this->filePath, "r");
        if (!$file) {
            throw new Exception("Could not open the file!" . PHP_EOL);
        }

        $this->file = $file;
    }


    private function incrementLineCounter(): void
    {
        $this->lineCounter++;
    }

    private function resetLineCounter(): void
    {
        $this->lineCounter = 0;
    }
}