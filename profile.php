<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if (isset($_SESSION['user'])) : ?>

        <p>Welcome <?= $_SESSION['user']['name'] ?>!</p>
        <p>Your bio: <br><?= $_SESSION['user']['bio'] ?></p>
        <p>Your email address: <br> <?= $_SESSION['user']['email'] ?></p>
        <p>If you wish to change your bio, email address or password you can <a href="update.php">UPDATE</a> your profile. </p>
    <?php endif; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
