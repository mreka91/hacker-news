<?php require __DIR__ . '/views/header.php'; ?>


<article>
    <h1>Create an account</h1>
    <!-- display an error message if pw and email not match or if email is in use already -->
    <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-danger">
            <?php foreach ($_SESSION['errors'] as $error) : ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        </div>
    <?php endif; ?>

    <form action="app/users/register.php" method="post">

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Reka Madarasz" required>
            <small class="form-text text-muted">Please provide your full name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="name">Bio</label>
            <input class="form-control" type="text" name="bio" id="bio" placeholder="I love long walks on the beach...">
            <small class="form-text text-muted">You can add your bio later.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Please provide your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
