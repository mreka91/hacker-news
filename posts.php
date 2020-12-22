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
        <article>
            <h2><?= $post['title'] ?></h2>
            <p> <a href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a></p>
            <p><?= $post['description'] ?></p>
            <small>Posted at <?= $post['created_at'] ?></small>
            <small>By <?= $post['name'] ?></small>
            <a href="comments.php?id=<?= $post['id']; ?>">Comments</a>
        </article>
    <?php endforeach; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
