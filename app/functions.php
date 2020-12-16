<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//adds an error message to session error variable
if (!function_exists('errorMessage')) {

    function errorMessage(string $message): void
    {
        $_SESSION['errors'][] = "${message}";
    }
}
