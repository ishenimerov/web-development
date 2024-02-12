<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>

    <body>
        <?php (include('common/header/header.php')) ?>

    </body>

    </html>
    <?php
} else {
    header("Location: index.php");
    exit();
}
?>