<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <p>Welcome <?= $_SESSION['user']['name'] ?>!</p>
        <p>Your bio: <br> <?= $_SESSION['user']['bio'] ?></p>
        <p>Your email address: <br> <?= $_SESSION['user']['email'] ?></p>
        <p>Your picture: <br></p>
        <?php if (isset($_SESSION['user']['avatar'])) : ?>
            <img src="/assets/images/profile/<?= $_SESSION['user']['avatar']; ?>" style="width:200px;">
        <?php endif; ?>
        <p>If you wish to change your bio, email address or password you can update or delete your profile.</p>
        <button><a href="update.php">UPDATE PROFILE</a></button>
        <button><a href="updatepost.php">EDIT YOUR POSTS</a></button>
        <!-- <button class="delete"><a href="#">DELETE PROFILE</a></button> -->

        <form action="app/users/delete.php" method="post">
            <button type="submit" class="btn btn-danger">DELETE PROFILE</button>
        </form>
    <?php endif; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
