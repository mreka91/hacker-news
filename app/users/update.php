<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';



// In this file we update the user profile.
if (isset($_POST['bio'], $_POST['email'], $_POST['password'])) {
    $newBio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    $newEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $newPassword = $_POST['password'];

    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $id = $_SESSION['user']['id'];

    $statement = $database->prepare('UPDATE users SET bio = :newbio, email = :newemail, password = :newpassword WHERE id = :id');
    $statement->bindParam(':newbio', $newBio, PDO::PARAM_STR);
    $statement->bindParam(':newemail', $newEmail, PDO::PARAM_STR);
    $statement->bindParam(':newpassword', $newPassword, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //show a success message and redirect back to the profile page
    if ($user) {
        successMessage("Profile successfully updated!");
        redirect('../../profile.php');
    }

    // get the user info and save it to Session
    $statementInfo = $database->prepare('SELECT bio, email, password FROM users WHERE id = :id');
    $statementInfo->bindParam(':id', $id, PDO::PARAM_INT);
    $statementInfo->execute();

    $userInfo = $statementInfo->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user']['bio'] = $userInfo['bio'];
    $_SESSION['user']['email'] = $userInfo['email'];
    $_SESSION['user']['password'] = $userInfo['password'];
}
redirect('/');
