<?php
session_start();
?>

<header class="site-header">
    <a href="home.php" style="text-decoration: none;">
        <div class="site-identity" href="home.php">
            <img src="./assets/logo.svg" alt="logo" width="60">
            <h1>MountOn</h1>
        </div>
    </a>

    <nav class="site-navigation">
        <ul class="nav">

            <?php
            if (isset($_SESSION['user_name']) && $_SESSION['user_name'] === 'admin') {
                echo '<li><a class="nav-item" href="users.php">Users</a></li>';
            } else {
                echo '
            <li><a class="nav-item" href="create-post.php">Create Post</a></li>
            <li><a class="nav-item" href="my-post.php">My Posts</a></li>';
            }
            ?>
            <li><a class="nav-item" href="./auth/logout.php">Log Out</a></li>
        </ul>
    </nav>
</header>