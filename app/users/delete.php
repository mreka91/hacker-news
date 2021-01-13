<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete the user profile.

$id = $_SESSION['user']['id'];

$statement = $database->prepare('DELETE FROM users WHERE id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_STR);
$statement->execute();

$statement = $database->prepare('DELETE FROM posts WHERE user_id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_STR);
$statement->execute();

$statement = $database->prepare('DELETE FROM likes WHERE user_id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_STR);
$statement->execute();

$statement = $database->prepare('DELETE FROM comments WHERE user_id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_STR);
$statement->execute();

/* $isDeleted = $statement->fetch(PDO::FETCH_ASSOC);

if ($isDeleted) {
    successMessage("Your account has been successfully deleted.");
    redirect('/login.php');
} */


unset($_SESSION['user']);
redirect('../../index.php');
