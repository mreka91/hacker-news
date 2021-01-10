<?php require __DIR__ . '/views/header.php'; ?>
<?php

$statement = $database->prepare('SELECT posts.id, posts.title, posts.post_link, posts.description, posts.created_at, users.name FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY created_at DESC ');
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<article>
    <h1>Newest posts</h1>
    <p> Read what's new on News Hacker!</p>
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <?php foreach ($posts as $post) : ?>
        <div class="posts container py-5">
            <h2><?= $post['title'] ?></h2>
            <a class="link" href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a>
            <p><?= $post['description'] ?></p>
            <p class="comment"><a href="comments.php?id=<?= $post['id']; ?>">Comments</a></p>
            <small>Posted at <?= $post['created_at'] ?></small>
            <small>By <?= $post['name'] ?></small>

            <?php
            //count the likes matching the posts

            $id = $post['id'];

            $statement = $database->prepare('SELECT posts.*, COUNT(likes.post_id) AS votes FROM likes INNER JOIN posts ON posts.id = likes.post_id WHERE posts.id = :id GROUP BY posts.id');

            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $likes = $statement->fetchAll(PDO::FETCH_ASSOC);


            ?>
            <div class="like-container">
                <!-- like btn -->
                <form action="app/posts/likes.php" method="post">
                    <input type="hidden" name="id" value="<?= $post['id']; ?>">
                    <button type="submit" name="submit" class="like-btn"> <img src="assets/images/buttons/like.svg" alt="like" class="like"> </button>
                </form>
                <!-- unlike btn -->
                <form action="app/posts/deletelikes.php" method="post">
                    <input type="hidden" name="id" value="<?= $post['id']; ?>">
                    <button type="submit" name="submit" class="like-btn"> <img src="assets/images/buttons/dislike.svg" alt="dislike" class="like"> </button>
                </form>
                <?php foreach ($likes as $like) : ?>
                    <!-- number of likes -->
                    <p> <?= $like['votes']; ?> Upvotes</p>
                <?php endforeach; ?>
            </div>
        </div><!-- /posts-->
        <hr>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
