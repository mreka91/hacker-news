<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete comments from the database

if (isset($_POST['id'], $_GET['id'])) {
    $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //delete from database

    $statement = $database->prepare('DELETE FROM comments WHERE id = :commentId');
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->execute();

    //show a success message and redirect back to the page
    if ($statement) {
        successMessage("Comment deleted!");
        redirect('../../comments.php?id=' . $postId);
    }
}
