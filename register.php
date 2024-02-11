<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <div class="container">
        <div class='form-box'>
            <?php
            session_start();
            include "db_conn.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $uname = validate($_POST['uname']);
                $email = validate($_POST['email']);
                $pass = validate($_POST['password']);
                $name = validate($_POST['name']);

                // Hash the password for better security
                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (user_name, password, name, email) VALUES ('$uname', '$hashed_password', '$name', '$email')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: index.php?success=Registration successful. You can now log in.");
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                    header("Location: register.php?error=Registration failed. Please try again.");
                    exit();
                }
            }
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            <h2>Register</h2>
            <form method="post">
                <div class="form-field-box">

                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-field-box">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-field-box">

                    <label for="uname">Username:</label>
                    <input type="text" id="uname" name="uname" required>
                </div>
                <div class="form-field-box">

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class='form-actions-box'>
                    <button class="btn-text" type="button" onclick="location.href='index.php';">Already have an
                        account</button>
                    <button class="btn-submit" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>