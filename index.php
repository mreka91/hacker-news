<?php require __DIR__ . '/views/header.php'; ?>
<?php
//Get all the necessary info from posts, the author and count the likes each post has
$statement = $database->prepare('SELECT posts.*, users.name, COUNT(likes.post_id) AS votes FROM posts JOIN users ON users.id = posts.user_id JOIN likes on posts.id = likes.post_id GROUP BY posts.id ORDER BY votes DESC');
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<article>
    <h1>The hottest topics</h1>
    <p> Read what's everyone's been talking about on News Hacker!</p>
    <!-- success message to show the post is liked/unliked -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <!-- here comes every post in order of most likes/upvoted first -->
    <?php foreach ($posts as $post) : ?>
        <div class="posts container py-5">
            <h2><?= $post['title'] ?></h2>
            <a class="link" target="_blank" rel="noopener noreferrer" href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a>
            <p><?= $post['description'] ?></p>
            <p class="comment"><a href="comments.php?id=<?= $post['id']; ?>">Comments</a></p>
            <small>Posted at <?= $post['created_at'] ?></small>
            <small>By <?= $post['name'] ?></small>
            <!-- Only show like buttons when user is logged in -->
            <div class="like-container">
                <?php if (isset($_SESSION['user'])) : ?>
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
                <?php else : ?>
                    <small>Please login or register to upvote a post.</small>
                <?php endif; ?>
                <!-- number of likes -->
                <p> <?= $post['votes']; ?> Upvotes</p>
            </div>
        </div><!-- /posts-->
        <hr>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
