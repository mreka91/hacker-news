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

        <h5>Bio: </h5>
        <p><?= $_SESSION['user']['bio'] ?></p>
        <h5>Your email address: </h5>
        <p><?= $_SESSION['user']['email'] ?></p>

        <!-- edit all user info -->
        <div class="buttons">
            <h4>Edit your profile by clicking the button below.</h4>
            <a href="update.php" class="btn btn-lg btn-outline-primary" role="button">UPDATE PROFILE</a>
        </div>
        <div class="buttons">
            <h4>Edit your posts by clicking the button below.</h4>
            <a href="updatepost.php" class="btn btn-lg btn-outline-primary" role="button">EDIT POSTS</a>
        </div>
        <!-- to delete a user profile -->
        <div class="buttons danger-zone">
            <h4>You will permanently DELETE your profile, every post comment and like by clicking the button below.</h4>
            <form action="app/users/delete.php" method="post">

                <input type="submit" value="Delete" class="btn btn-lg btn-outline-danger" />
            </form>
        </div>
    <?php endif; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
