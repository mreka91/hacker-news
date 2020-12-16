<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <a class="nav-link" href="/posts.php">New posts</a>
        </li><!-- /nav-item -->

        <?php if (!isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/login.php">Login</a>
            </li><!-- /nav-item -->
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="./app/users/logout.php">Logout</a>
            </li><!-- /nav-item -->
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" href="/register.php">Register</a>
        </li><!-- /nav-item -->
    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
