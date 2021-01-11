<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['avatar'])) {
    //die(var_dump($_FILES['avatar']));
    $avatar = $_FILES['avatar'];

    //destination
    $destination = __DIR__ . '/../../assets/images/profile/' . $avatar['name'];

    $id = $_SESSION['user']['id'];



    if (!in_array($avatar['type'], ['image/jpeg', 'image/png'])) {
        errorMessage("The uploaded file is not the supported png or jpeg format.");
    } else {
        move_uploaded_file($avatar['tmp_name'], $destination);

        //to store it in the database
        $statement = $database->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
        $statement->bindParam(':avatar', $avatar['name'], PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();


        // get the user pic and save it to Session
        $statementUser = $database->prepare('SELECT avatar FROM users WHERE id = :id');
        $statementUser->bindParam(':id', $id, PDO::PARAM_INT);
        $statementUser->execute();

        $userPic = $statementUser->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user']['avatar'] = $userPic['avatar'];

        //show a success message and redirect back to the profile page
        if ($userPic) {
            successMessage("Profile picture uploaded!");
            redirect('../../update.php');
        }
    }
    redirect('../../update.php');
}

//redirect('../../profile.php');
