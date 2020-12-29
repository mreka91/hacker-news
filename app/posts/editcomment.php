<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


// to edit a comment

if (isset($_POST['id'], $_POST['content'], $_GET['id'])) {
    $commentId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //update the comment details in the database
    $statement = $database->prepare('UPDATE comments SET content = :content WHERE id = :commentId');
    $statement->bindParam(':content', $content, PDO::PARAM_STR);
    $statement->bindParam(':commentId', $commentId, PDO::PARAM_INT);
    $statement->execute();

    //show a success message and redirect back to the update post page
    if ($statement) {
        successMessage("Comment successfully edited!");
        redirect('../../comments.php?id=' . $postId);
    }
}
