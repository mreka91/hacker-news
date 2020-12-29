<?php require __DIR__ . '/views/header.php'; ?>

<?php

// show the post the user clicked on
$id = $_GET['id'];
$statement = $database->prepare('SELECT * FROM posts  WHERE id = :id');
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$post = $statement->fetch(PDO::FETCH_ASSOC);

// select the data from the comments table

$statement = $database->prepare('SELECT * FROM comments WHERE post_id = :postId ORDER BY created_at DESC');
$statement->bindParam(':postId', $id, PDO::PARAM_INT);
$statement->execute();


$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- SHOW THE POST -->
<article>
    <h2><?= $post['title'] ?></h2>
    <p> <a href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a></p>
    <p><?= $post['description'] ?></p>
    <small>Posted at <?= $post['created_at'] ?></small>
    <hr>
</article>


<!-- COMMENTS -->
<article>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user'])) : ?>

        <h6>You have to be logged in to be able to comment</h6>
        <hr>
    <?php endif; ?>
    <!-- ADD COMMENTS -->
    <?php if (isset($_SESSION['user'])) : ?>

        <form action="app/posts/addcomment.php?id=<?= $post['id']; ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" readonly name="name" id="name" value="<?= $_SESSION['user']['name'] ?>" class="form-control" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="content">Message</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div><!-- /form-group -->

            <button type="submit" class="btn btn-lg btn-primary">Add comment</button>
        </form><!-- /col-lg-6 -->
    <?php endif; ?>

    <!-- DISPLAY COMMENTS -->
    <h5>Comments</h5>
    <?php foreach ($comments as $comment) : ?>
        <small><?= $comment['name']; ?> commented on</small>
        <small><?= $comment['created_at']; ?></small>
        <p><?= $comment['content']; ?></p>

        <!-- EDIT COMMENT -->
        <div class="edit-com">
            <?php if ($_SESSION['user']['id'] === $comment['user_id']) : ?>
                <form action="app/posts/editcomment.php?id=<?= $post['id']; ?>" method="post">
                    <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                    <div class="form-group">
                        <label for="content">Edit comment</label>
                        <input name="content" id="content" class="form-control" value="<?= $comment['content'] ?>" required></input>
                    </div><!-- /form-group -->
                    <button type="submit" class="btn  btn-sm btn-info">Edit</button>
                </form>
        </div>
        <!-- DELETE COMMENT -->
        <div class="delete-com">
            <form action="app/posts/deletecomment.php?id=<?= $post['id']; ?>" method="post">
                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                <button type="submit" class="btn  btn-sm btn-danger">Delete</button>
            </form>
        <?php endif; ?>
        </div>
    <?php endforeach; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
