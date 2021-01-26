<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['post_id'], $_POST['id'])) {
    $userId = $_SESSION['user']['id'];
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);


    $statement = $database->prepare('DELETE FROM comments_responses WHERE id = :id AND user_id = :userId');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
    $statement->execute();




    redirect('/comments.php?id=' . $postId);
}
