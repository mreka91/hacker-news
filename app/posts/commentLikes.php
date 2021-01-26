<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['id'], $_POST['post_id'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
    $user_id = $_SESSION['user']['id'];

    //add to the database

    $statement = $database->prepare('INSERT INTO comments_likes (user_id, comment_id) VALUES ( :user_id, :comment_id)');
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':comment_id', $id, PDO::PARAM_INT);

    $statement->execute();

    redirect('/comments.php?id=' . $post_id);
}
