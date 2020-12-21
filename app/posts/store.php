<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.

if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $post_link = filter_var($_POST['link'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    $id = $_SESSION['user']['id'];

    //add to database

    $statement = $database->prepare('INSERT INTO posts (title, post_link, description, created_at, user_id) VALUES (:title, :post_link, :description, CURRENT_TIMESTAMP, :id)');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':post_link', $post_link, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();


    $statement = $database->prepare('SELECT * FROM posts WHERE user_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();


    $post = $statement->fetch(PDO::FETCH_ASSOC);

    //show a success message
    if ($post) {
        successMessage("Your post is uploaded!");
        redirect('../../post.php');
    }

    //redirect('/index.php');
}
















redirect('/');
