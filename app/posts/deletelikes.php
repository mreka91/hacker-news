<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete likes from the database


if (isset($_POST['id'])) {
    $user_id = $_SESSION['user']['id'];
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    //add to the database

    $statement = $database->prepare('DELETE FROM likes WHERE post_id = :id and user_id = :user_id');
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);


    $statement->execute();



    //show a success message and redirect back to the page
    if ($statement) {
        successMessage("Like deleted!");
        redirect('../../posts.php');
    }
}
