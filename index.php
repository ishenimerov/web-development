<!DOCTYPE html>

<html>

<head>

    <title>LOGIN</title>

    <link rel="stylesheet" href="style/style.css">

</head>

<body>
    <div class="container">
        <div class='form-box'>
            <?php
            session_start();
            if (isset($_SESSION['id'])) {
                header("Location: home.php");
            } ?>
            <h2>LOGIN</h2>
            <form action="auth/login.php" method="post">
                <?php if (isset($_GET['error'])) { ?>

                    <p class="error">
                        <?php echo $_GET['error']; ?>
                    </p>

                <?php } ?>
                <div class='form-field-box'>
                    <label>Username</label>
                    <input type="text" name="uname" placeholder="Email">
                </div>
                <div class='form-field-box'>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class=' form-actions-box'>
                    <button class="btn-text" type="button" onclick="location.href='auth/register.php';">Sign up</button>
                    <button class="btn-submit" type="submit">Login</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>