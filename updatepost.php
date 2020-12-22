<?php require __DIR__ . '/views/header.php';
if (!isset($_SESSION['user'])) {
    redirect('/');
}
$user = $_SESSION['user']['id'];
$statement = $database->prepare('SELECT id, title, post_link, description FROM posts WHERE user_id = :user ORDER BY created_at DESC');
$statement->bindParam(':user', $user, PDO::PARAM_INT);
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<h1>You will find all your posts here</h1>
<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success">
        <?php foreach ($_SESSION['success'] as $succ) : ?>
            <p><?= $succ ?></p>
        <?php endforeach; ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>
<?php foreach ($posts as $post) : ?>
    <article>
        <!-- form to UPDATE a post -->
        <form action="app/posts/update.php" method="post">
            <!-- get the posts id -->
            <div class="form-group">
                <input type=hidden class="form-control" type="text" name="id" id="id" value="<?= $post['id'] ?>" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="<?= $post['title'] ?>" required>
                <small class="form-text text-muted">Please edit the title.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="post_link">Link</label>
                <input class="form-control" type="text" name="post_link" id="post_link" value="<?= $post['post_link'] ?>" required>
                <small class="form-text text-muted">Please edit the link.</small>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="description">Description</label>
                <input class="form-control" type="text" name="description" id="description" value="<?= $post['description'] ?>" required>
                <small class="form-text text-muted">Please edit the description.</small>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-primary">Update post</button>
        </form>

        <!-- to DELETE a post -->
        <form action="app/posts/delete.php" method="post">
            <div class="form-group">
                <input type=hidden class="form-control" type="text" name="id" id="id" value="<?= $post['id'] ?>" required>
            </div><!-- /form-group -->
            <button type="submit" class="btn btn-danger">DELETE POST</button>
        </form>

    </article>

<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>
