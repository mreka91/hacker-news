<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}
redirect('../../index.php');
// In this file we logout users.
