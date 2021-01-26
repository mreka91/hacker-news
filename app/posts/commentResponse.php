<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['content'], $_POST['post_id'], $_POST['comment_id'])) {
    $userId = $_SESSION['user']['id'];
    $commentId = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

    $_SESSION['isEmpty'] = null;

    if ($content === '') {
        $_SESSION['isEmpty'] = "Please fill in a comment";
    } else {
        unset($_SESSION['isEmpty']);
        $statement = $database->prepare('INSERT INTO comments_responses (user_id, comment_id, content) VALUES (:user_id, :comment_id, :content)');
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
        $statement->bindParam(':content', $content, PDO::PARAM_STR);

        $statement->execute();
    }

    redirect('/comments.php?id=' . $postId);
}
