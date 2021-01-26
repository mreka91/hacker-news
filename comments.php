<?php require __DIR__ . '/views/header.php'; ?>

<?php

if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
}


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
<article class="comment-article">
    <!-- shows a success message if the comment was posted succesfully -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="alert alert-success">
            <?php foreach ($_SESSION['success'] as $succ) : ?>
                <p><?= $succ ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    <!-- only logged in users can comment -->
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
    <div class="comments-displayed">
        <hr>
        <h2 style="color: blue;">Comments</h2>
        <?php foreach ($comments as $comment) : ?>
            <?php $responses = getCommentResponse($database, $comment['id']); ?>
            <div class="commentsMain-displayed">
                <small><?= $comment['name']; ?> commented on</small>
                <small><?= $comment['created_at']; ?></small>
                <p><?= $comment['content']; ?></p>
            </div>

            <div class="like-container-comment">
                <?php $commentLikes = getCommentLikes($database, $comment['id']); ?>
                <!-- like comment -->
                <p>Likes:<?php echo $commentLikes; ?> </p>
                <?php if (isset($_SESSION['user'])) : ?>
                    <?php $isCommentLiked = isCommentLiked($database, $user_id, $comment['id']); ?>
                    <?php if (!is_array($isCommentLiked)) : ?>
                        <form action="app/posts/commentLikes.php" method="post">
                            <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                            <input type="hidden" name="post_id" value="<?= $id ?>">
                            <button type="submit" name="submit" class="like-btn">
                                <svg class="like" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M512 304c0-12.821-5.099-24.768-13.888-33.579 9.963-10.901 15.04-25.515 13.653-40.725-2.496-27.115-26.923-48.363-55.637-48.363H324.352c6.528-19.819 16.981-56.149 16.981-85.333 0-46.272-39.317-85.333-64-85.333-22.144 0-37.995 12.48-38.656 12.992A10.672 10.672 0 00234.666 32v72.341L173.205 237.44l-2.539 1.301v-4.075c0-5.888-4.779-10.667-10.667-10.667H53.333C23.915 224 0 247.915 0 277.333V448c0 29.419 23.915 53.333 53.333 53.333h64c23.061 0 42.773-14.72 50.197-35.264C185.28 475.2 209.173 480 224 480h195.819c23.232 0 43.563-15.659 48.341-37.248 2.453-11.136 1.024-22.336-3.84-32.064 15.744-7.915 26.347-24.192 26.347-42.688 0-7.552-1.728-14.784-4.992-21.312C501.419 338.752 512 322.496 512 304zm-44.992 26.325a10.719 10.719 0 00-8.917 7.232 10.688 10.688 0 002.816 11.136c5.419 5.099 8.427 11.968 8.427 19.307 0 13.461-10.176 24.768-23.637 26.325a10.719 10.719 0 00-8.917 7.232 10.688 10.688 0 002.816 11.136c7.019 6.613 9.835 15.893 7.723 25.451-2.624 11.904-14.187 20.523-27.499 20.523H224c-17.323 0-46.379-8.128-56.448-18.219-3.051-3.029-7.659-3.925-11.627-2.304a10.667 10.667 0 00-6.592 9.856c0 17.643-14.357 32-32 32h-64c-17.643 0-32-14.357-32-32V277.333c0-17.643 14.357-32 32-32h96V256c0 3.691 1.92 7.125 5.077 9.088a10.902 10.902 0 0010.368.448l21.333-10.667a10.65 10.65 0 004.907-5.056l64-138.667c.64-1.408.981-2.944.981-4.48V37.781c4.438-2.453 12.14-5.781 21.334-5.781C289.024 32 320 61.056 320 96c0 37.547-20.437 91.669-20.629 92.203a10.739 10.739 0 001.173 9.856 10.728 10.728 0 008.789 4.608h146.795c17.792 0 32.896 12.736 34.389 28.992 1.131 12.16-4.715 23.723-15.189 30.187-3.264 2.005-5.205 5.632-5.056 9.493s2.368 7.317 5.781 9.088c9.024 4.587 14.613 13.632 14.613 23.573.001 13.461-10.175 24.768-23.658 26.325z" />
                                    <path d="M160 245.333c-5.888 0-10.667 4.779-10.667 10.667v192c0 5.888 4.779 10.667 10.667 10.667s10.667-4.779 10.667-10.667V256c0-5.888-4.779-10.667-10.667-10.667z" />
                                </svg>
                            </button>
                        </form>
                    <?php else : ?>
                        <!-- unlike comment -->
                        <form action="app/posts/deletecommentlikes.php" method="post">
                            <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                            <input type="hidden" name="post_id" value="<?= $id ?>">
                            <button type="submit" name="submit" class="like-btn">
                                <svg class="unlike" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.012 512.012">
                                    <path d="M498.133 241.585c8.768-8.811 13.867-20.757 13.867-33.579 0-18.496-10.581-34.752-26.325-42.688 3.264-6.528 4.992-13.76 4.992-21.312 0-18.496-10.603-34.773-26.347-42.688 4.864-9.728 6.293-20.928 3.84-32.043-4.779-21.611-25.109-37.269-48.341-37.269H224c-14.827 0-38.72 4.8-56.469 13.931-7.424-20.544-27.136-35.264-50.197-35.264h-64C23.915 10.673 0 34.587 0 64.006v170.667c0 29.419 23.915 53.333 53.333 53.333H160c5.888 0 10.667-4.779 10.667-10.667v-4.075l2.539 1.28 61.461 133.12v72.341c0 3.243 1.472 6.315 3.989 8.341.683.512 16.533 12.992 38.677 12.992 24.683 0 64-39.061 64-85.333 0-29.184-10.453-65.515-16.981-85.333h131.776c28.715 0 53.141-21.248 55.659-48.363 1.386-15.21-3.691-29.823-13.654-40.724zm-22.805 8.597c10.475 6.464 16.32 18.027 15.189 30.187-1.493 16.235-16.597 28.971-34.389 28.971H309.333a10.726 10.726 0 00-8.789 4.608c-1.984 2.901-2.432 6.592-1.173 9.856.192.533 20.629 54.656 20.629 92.203 0 34.944-30.976 64-42.667 64-9.195 0-16.917-3.349-21.333-5.781v-68.885a10.55 10.55 0 00-1.003-4.48l-64-138.667a10.645 10.645 0 00-4.907-5.056l-21.333-10.667c-3.307-1.664-7.253-1.451-10.368.448-3.136 1.963-5.056 5.397-5.056 9.088v10.667h-96c-17.643 0-32-14.357-32-32V64.006c0-17.643 14.357-32 32-32h64c17.643 0 32 14.357 32 32 0 4.309 2.603 8.213 6.592 9.856a10.777 10.777 0 0011.627-2.304C177.621 61.467 206.677 53.339 224 53.339h195.819c13.312 0 24.875 8.619 27.499 20.565 2.112 9.536-.704 18.795-7.723 25.429a10.624 10.624 0 00-2.816 11.136 10.685 10.685 0 008.917 7.232c13.461 1.536 23.637 12.843 23.637 26.304 0 7.339-3.008 14.208-8.405 19.328a10.624 10.624 0 00-2.816 11.136 10.685 10.685 0 008.917 7.232c13.461 1.536 23.637 12.843 23.637 26.304 0 9.941-5.589 18.987-14.613 23.595a10.747 10.747 0 00-5.781 9.088 10.703 10.703 0 005.056 9.494z" />
                                    <path d="M160 53.339c-5.888 0-10.667 4.779-10.667 10.667v192c0 5.888 4.779 10.667 10.667 10.667s10.667-4.779 10.667-10.667v-192c0-5.888-4.779-10.667-10.667-10.667z" />
                                </svg>
                            </button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!-- /form-group -->

            <?php if (isset($_SESSION['user'])) : ?>
                <form action="app/posts/commentResponse.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $id ?>">
                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                    <textarea name="content" id="content" class="form-control" required></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Reply to comment</button>
                </form>

            <?php endif; ?>
            <?php foreach ($responses as $response) : ?>
                <div class="commentsResponse-displayed">
                    <small><?= $response['name']; ?> commented on comment: </small> <br>
                    <small style="color: cornflowerblue;"><?= $response['content']; ?></small>
                </div>
                <?php if (isset($_SESSION['user'])) : ?>
                    <div class="delete-com">
                        <form action="app/posts/deleteCommentResponse.php" method="post">
                            <input type="hidden" name="id" value="<?= $response['id'] ?>">
                            <input type="hidden" name="post_id" value="<?= $id ?>">
                            <button type="submit" class="btn  btn-sm btn-danger">Delete reply</button>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['isEmpty'])) : ?>
                    <p><?php echo $_SESSION['isEmpty']; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- EDIT COMMENT -->
            <?php if (isset($_SESSION['user'])) : ?>
                <div class="edit-comment">
                    <?php if ($_SESSION['user']['id'] === $comment['user_id']) : ?>
                        <div class="edit-com">
                            <form action="app/posts/editcomment.php?id=<?= $post['id']; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                <div class="form-group">
                                    <label for="content">Edit comment &#8595;</label>
                                    <input name="content" id="content" class="form-control" value="<?= $comment['content'] ?>" required></input>
                                    <button type="submit" class="btn  btn-sm btn-info">Edit</button>
                            </form>
                        </div>
                        <!-- DELETE COMMENT -->
                        <div class="delete-com">
                            <form action="app/posts/deletecomment.php?id=<?= $post['id']; ?>" method="post">
                                <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                <button type="submit" class="btn  btn-sm btn-danger">Delete</button>
                            </form>
                        </div>

                    <?php endif; ?>
                    <hr>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
