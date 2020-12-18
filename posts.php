<?php require __DIR__ . '/views/header.php'; ?>
<?php

$statement = $database->prepare('SELECT posts.title, posts.post_link, posts.description, posts.created_at, users.name FROM posts INNER JOIN users ON users.id = posts.user_id ORDER BY created_at DESC ');
$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<article>
    <h1>Newest posts</h1>
    <p>Here you can read the newest posts.</p>

    <?php foreach ($posts as $post) : ?>
        <h2><?= $post['title'] ?></h2>
        <p> <a href="<?= $post['post_link'] ?>"><?= $post['post_link'] ?> </a></p>
        <p><?= $post['description'] ?></p>
        <p>Posted at <?= $post['created_at'] ?></p>
        <p>By <?= $post['name'] ?></p>
    <?php endforeach; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
