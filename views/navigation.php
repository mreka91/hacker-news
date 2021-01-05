<nav class="navbar navbar-expand-lg navbar-light navigation">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php"><img src="assets/images/logo.png" alt="News Hacker Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
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
                        <a class="nav-link" data-toggle="collapse" href="/post.php">Create post</a>
                    </li><!-- /nav-item -->
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li><!-- /nav-item -->
                <?php endif; ?>
            </ul><!-- /navbar-nav -->
            <ul class="navbar-nav ml-auto">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" data-target="#myModal" data-toggle="modal" href="/login.php">Login</a>
                    </li><!-- /nav-item -->
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./app/users/logout.php">Logout</a>
                    </li><!-- /nav-item -->
                <?php endif; ?>
            </ul><!-- /navbar-nav -->
        </div>
    </div>
</nav><!-- /navbar -->
