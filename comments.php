<?php require __DIR__ . '/views/header.php'; ?>

<?php
$id = $_GET['id'];
$statement = $database->prepare('SELECT * FROM posts  WHERE id = :id ');
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);
?>

<article>
    <h2><?= $post['title'] ?></h2>
    <p> <a href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a></p>
    <p><?= $post['description'] ?></p>
    <small>Posted at <?= $post['created_at'] ?></small>
</article>
<article>
    <?php if (isset($_SESSION['user'])) : ?>
        <form class="" action="addcomment.php" method="post">
            <hr>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $_SESSION['user']['name'] ?>" class="form-control" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-primary">Add comment</button>
        </form><!-- /col-lg-6 -->
    <?php endif; ?>

    <div class="row mt-4">
        <div class="col-lg-6 offset-lg-3">
            <h1 class="h5">Comments</h1>
            <?php foreach ($comments as $comment) : ?>
                <small><?php echo $comment['name']; ?></small>
                <p><?php echo $comment['message']; ?></p>
            <?php endforeach; ?>
        </div><!-- /col-lg-6 -->
    </div><!-- /row -->
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
