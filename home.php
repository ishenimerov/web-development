<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>HOME</title>
        <!--FONT AWESOME-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--GOOGLE FONTS-->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>

    <body>
        <div class='wrapper'>
            <?php (include('common/header/header.php')) ?>
            <main>
                <div class="main-box top">
                    <div class="top">
                        <div>
                            <?php echo "<h2>Welcome, $name!</h2>"; ?>
                            <p>Explore our recipes and categories below:</p>
                        </div>
                    </div>
                </div>
            </main>
            <?php (include('common/footer/footer.php')) ?>
        </div>

    </body>


    </html>
    <?php
} else {
    header("Location: index.php");
    exit();
}
?>