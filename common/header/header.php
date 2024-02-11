<div class="nav">
    <div class="logo">
        <a href="home.php" id="logo">FoodRecipes</a>
    </div>
    <nav class="nav-links">
        <a href="home.php">Home</a>

        <?php
        if ($_SESSION['is_admin'] == 1) {
            echo "<a href='usersList.php'>Users List</a>";
        }
        ?>

    </nav>
    <div class="right-links">
        <a href="account.php">Account</a>
        <a href="utils/logout.php"><button class="btn">Log Out</button></a>
    </div>
</div>