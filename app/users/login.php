<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we login users.

if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        errorMessage("Password or email does not match. Have you created an account, yet?");
        redirect('/login.php');
    }

    if (
        isset($user['password']) &&
        password_verify($password, $user['password'])
    ) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
        ];

        //redirect('/');
    } else {
        errorMessage("Password or email does not match. Have you created an account, yet?");
    }
}
redirect('/');
