<?php require __DIR__ . '/views/header.php';
if (!isset($_SESSION['user'])) {
    redirect('/');
}
?>

<article>
    <h1>Update your Profile</h1>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <form action="app/users/update.php" method="post">

        <div class="form-group">
            <label for="name">Bio</label>
            <input class="form-control" type="text" name="bio" id="bio" placeholder="I love long walks on the beach..." required>
            <small class="form-text text-muted">Please provide your new biography.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?= $_SESSION['user']['email'] ?>" required>
            <small class="form-text text-muted">Please provide your new email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Please provide your new password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Update</button>
    </form>


</article>

<?php require __DIR__ . '/views/footer.php'; ?>
