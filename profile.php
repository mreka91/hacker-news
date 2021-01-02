<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1>Profile Page</h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <div class="profile">
            <?php if (isset($_SESSION['user']['avatar'])) : ?>
                <img src="/assets/images/profile/<?= $_SESSION['user']['avatar']; ?>">
            <?php endif; ?>
        </div>

        <h2><?= $_SESSION['user']['name'] ?></h2>

        <p>Short bio: <br> <?= $_SESSION['user']['bio'] ?></p>
        <p>Your registered email address: <br> <?= $_SESSION['user']['email'] ?></p>
        <div class="buttons">
            <h4>You can edit your profile by clicking the UPDATE PROFILE button below.</h4>
            <a href="update.php" class="btn btn-lg btn-outline-primary" role="button">UPDATE PROFILE</a>
        </div>
        <div class="buttons">
            <h4>You can edit your posts by clicking the UPDATE POSTS button below.</h4>
            <a href="updatepost.php" class="btn btn-lg btn-outline-primary" role="button">EDIT YOUR POSTS</a>
        </div>
        <!-- to delete a user profile -->
        <div class="buttons">
            <form action="app/users/delete.php" method="post">
                <h4>You can DELETE your profile by clicking the button below.</h4>
                <button type="submit" class="btn btn-lg btn-outline-danger">DELETE PROFILE</button>
            </form>
        </div>
    <?php endif; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
