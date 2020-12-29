<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new comments in the database

//to add a comment

if (isset($_POST['name'], $_POST['content'], $_GET['id'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);


    $userId = $_SESSION['user']['id'];
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //add to database

    $statement = $database->prepare('INSERT INTO comments (name, content, created_at, user_id, post_id) VALUES (:name, :content, CURRENT_TIMESTAMP, :userId, :postId)');
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->bindParam(':postId', $postId, PDO::PARAM_INT);

    $statement->execute();

    //show a success message and redirect back to the page
    if ($statement) {
        successMessage("Comment successfully posted!");
        redirect('../../comments.php?id=' . $postId);
    }
}
