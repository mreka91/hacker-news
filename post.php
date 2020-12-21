<?php require __DIR__ . '/views/header.php'; ?>


<article>
    <h1>Create a post</h1>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form action="app/posts/store.php" method="post">

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Title" required>
            <small class="form-text text-muted">Please provide a title.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" id="link" placeholder="www.yrgo.com" required>
            <small class="form-text text-muted">Please provide the link.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description" required>
            <small class="form-text text-muted">Please provide a short description.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Create post</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
