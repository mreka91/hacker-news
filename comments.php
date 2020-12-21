<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <form class="col-lg-6 offset-lg-3" action="" method="post">
        <hr>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" class="form-control"></textarea>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Add comment</button>
    </form><!-- /col-lg-6 -->


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
