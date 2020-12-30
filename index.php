<?php require __DIR__ . '/views/header.php'; ?>
<?php

$statement = $database->prepare('SELECT posts.id, posts.title, posts.post_link, posts.description, posts.created_at, users.name FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY created_at DESC ');
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<article>
    <h1>Newest posts</h1>
    <p> Read what's new on Hacker News!</p>

    <?php foreach ($posts as $post) : ?>
        <div class="posts container py-5">
            <h2><?= $post['title'] ?></h2>
            <p class="link"> <a href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a></p>
            <p><?= $post['description'] ?></p>
            <p class="comment"><a href="comments.php?id=<?= $post['id']; ?>">Comments</a></p>
            <small>Posted at <?= $post['created_at'] ?></small>
            <small>By <?= $post['name'] ?></small>
            <form action="app/posts/likes.php">
                <input type="hidden" name="id" value="<?= $post['id']; ?>">
                <button type="submit" name="like" value="like" class="like-btn"> <img src="assets/images/buttons/like.svg" alt="like" class="like"> </button>
                <button type="submit" name="dislike" value="dislike" class="like-btn"> <img src="assets/images/buttons/dislike.svg" alt="dislike" class="like"> </button>
            </form>
        </div><!-- /posts-->
        <hr>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
