<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.

if (isset($_POST['name'], $_POST['bio'], $_POST['email'], $_POST['password'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $bio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);



    //control if email address exists

    $statement = $database->prepare('SELECT email FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $isEmail = $statement->fetch(PDO::FETCH_ASSOC);

    if ($isEmail) {
        errorMessage("Email already exists. Try logging in.");
        redirect('/login.php');
    }

    //register and add to database

    $statement = $database->prepare('INSERT INTO users (name, bio, email, password) VALUES (:name, :bio, :email, :password)');
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);



    redirect('/login.php');
}




redirect('/');
