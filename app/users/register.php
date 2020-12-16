<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $statement = $database->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $statement->bindParam(':name', $email, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/login.php');
}




redirect('/');
