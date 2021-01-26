<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//adds an error message to session error variable
if (!function_exists('errorMessage')) {

    function errorMessage(string $message): void
    {
        $_SESSION['errors'][] = "${message}";
    }
}
//adds a success message
if (!function_exists('successMessage')) {

    function successMessage(string $message): void
    {
        $_SESSION['success'][] = "${message}";
    }
}

function getCommentLikes($database, $commentId)
{
    $statement = $database->prepare('SELECT COUNT(comment_id) as count FROM comments_likes WHERE comment_id = :comment_id');
    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $statement->execute();

    $commentLike = $statement->fetch(PDO::FETCH_ASSOC);

    return $commentLike['count'];
}


function isCommentLiked($database, $user_id, $comment_id)
{
    $db = ('SELECT * FROM comments_likes WHERE user_id = :user_id AND comment_id = :comment_id;');
    $statement = $database->prepare($db);

    $statement->bindParam(':user_id', $user_id);
    $statement->bindParam(':comment_id', $comment_id);

    $statement->execute();

    $isLiked = $statement->fetch(PDO::FETCH_ASSOC);
    return $isLiked;
}


function getCommentResponse($database, $commentId)
{

    $statement = $database->prepare('SELECT comments_responses.id, comments_responses.user_id, comments_responses.comment_id, comments_responses.content, users.name
    FROM comments_responses
    JOIN users
    ON users.id = comments_responses.user_id
    WHERE comment_id = :comment_id');

    $statement->bindParam(':comment_id', $commentId, PDO::PARAM_INT);
    $statement->execute();

    $responses = $statement->fetchAll(PDO::FETCH_ASSOC);



    return $responses;
}
