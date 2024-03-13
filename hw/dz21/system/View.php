<?php

class View
{
    public function render(string $path, ?array $variables = []): bool
    {
        $file = VIEWS_DIR . $path;
        if (!file_exists($file)) {
            throw new Exception('View not found');
        }

        if ($variables) {
            extract($variables);
        }

        ob_start();
        require $file;
        echo ob_get_clean();

        return true;
    }
}