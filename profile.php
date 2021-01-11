<?php require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

$user = $_SESSION['user']['id'];
$statement = $database->prepare('SELECT * FROM users WHERE id = :user');
$statement->bindParam(':user', $user, PDO::PARAM_INT);
$statement->execute();

$userInfo = $statement->fetch(PDO::FETCH_ASSOC);
?>

<article class="profile-page">
    <h1>Profile Page</h1>

    <div class="profile-pic">
        <img src="/assets/images/profile/<?= $userInfo['avatar']; ?>">
    </div>

    <div class="profile-info">
        <h2><?= $userInfo['name'] ?></h2>
        <h5>Bio: </h5>
        <p class="bio"><?= $userInfo['bio'] ?></p>
        <h5>Your email address: </h5>
        <p><?= $userInfo['email'] ?></p>
    </div>

    <div class="profile-buttons">
        <!-- edit all user info -->
        <div class="buttons">
            <h4>Edit your profile by clicking the button below.</h4>
            <a href="update.php" class="btn btn-lg btn-outline-primary" role="button">UPDATE PROFILE</a>
        </div>
        <!-- edit all user post -->
        <div class="buttons">
            <h4>Edit your posts by clicking the button below.</h4>
            <a href="updatepost.php" class="btn btn-lg btn-outline-primary" role="button">EDIT POSTS</a>
        </div>
        <!-- to delete a user profile -->
        <div class="buttons danger-zone">
            <h4>You will permanently DELETE your profile and every post, comment and upvote you had by clicking the button below.</h4>
            <form action="app/users/delete.php" method="post">
                <input type="submit" value="Delete" class="btn btn-lg btn-outline-danger" />
            </form>
        </div>
    </div>


</article>

<?php require __DIR__ . '/views/footer.php'; ?>
