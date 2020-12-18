<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">Hacker img here</a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
        </li><!-- /nav-item -->

        <li class="nav-item">
            <a class="nav-link" href="/posts.php">New posts</a>
        </li><!-- /nav-item -->

        <?php if (!isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/register.php">Register</a>
            </li><!-- /nav-item -->
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/post.php">Create post</a>
            </li><!-- /nav-item -->
        <?php endif; ?>

        <?php if (isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
            </li><!-- /nav-item -->
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/login.php">Login</a>
            </li><!-- /nav-item -->
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="./app/users/logout.php">Logout</a>
            </li><!-- /nav-item -->
        <?php endif; ?>
    </ul><!-- /navbar-nav -->
</nav><!-- /navbar -->
