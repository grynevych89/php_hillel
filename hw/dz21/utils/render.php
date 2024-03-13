<?php

function render(string $path, ?array $variables = []): void
{
    try {
        $view = new View();
        $view->render($path, $variables);
    } catch (Exception $error) {
        print_r($error->getMessage());
    }
}