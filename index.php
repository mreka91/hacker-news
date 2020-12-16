<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>

    <?php if (isset($_SESSION['user'])) : ?>
        <p>Hello there, <?= $_SESSION['user']['name'] ?>.</p>
    <?php endif; ?>
    <p>This is the home page.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
