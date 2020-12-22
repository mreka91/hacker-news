<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (isset($_POST['id'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);


    //update the post details in the database
    $statement = $database->prepare('DELETE FROM posts WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();


    if ($statement) {
        successMessage("Post successfully deleted!");
        redirect('../../updatepost.php');
    }
}




//redirect('/');
