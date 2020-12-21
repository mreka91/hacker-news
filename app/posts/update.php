<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';



// In this file we update posts in the database.
if (isset($_POST['id'], $_POST['title'], $_POST['post_link'], $_POST['description'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $newtitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $newpost_link = filter_var($_POST['post_link'], FILTER_SANITIZE_STRING);
    $newdescription = filter_var($_POST['description'], FILTER_SANITIZE_STRING);



    //update
    $statement = $database->prepare('UPDATE posts SET title = :newtitle, post_link = :newpost_link, description = :newdescription WHERE id = :id');
    $statement->bindParam(':newtitle', $newtitle, PDO::PARAM_STR);
    $statement->bindParam(':newpost_link', $newpost_link, PDO::PARAM_STR);
    $statement->bindParam(':newdescription', $newdescription, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();



    //show a success message and redirect back to the profile page
    if ($statement) {
        successMessage("Post successfully updated!");
        redirect('../../updatepost.php');
    }
}
