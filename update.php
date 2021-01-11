<?php require __DIR__ . '/views/header.php';
if (!isset($_SESSION['user'])) {
    redirect('/');
}
?>

<article>
    <h1>Update your Profile</h1>
    <!-- show success message if profile was updated -->
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

<!-- upload a profile picture -->
<article class="img-form">
    <h2>Upload a new profile picture</h2>
    <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-danger">
            <?php foreach ($_SESSION['errors'] as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>

    <form action="app/users/uploadpic.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="avatar">Upload your avatar in PNG format.</label>
            <input type="file" class="form-control-file" name="avatar" id="avatar" accept=".jpg, .jpeg, .png" required>
            <small class="form-text text-muted">We only accept JPG, JPEG and PNG format.</small>
        </div>

        <button class="btn btn-primary" type="submit">Upload</button>
    </form>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
