<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>

<body>
    <div class="container">
        <div class='form-box'>
            <?php
            session_start();
            include "../db-conn/db_conn.php";

            if (isset($_POST['submit'])) {
                $uname = validate($_POST['uname']);
                $email = validate($_POST['email']);
                $password = validate($_POST['password']);
                $name = validate($_POST['name']);

                // Hash the password for better security
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Use prepared statement to avoid SQL injection
                $stmt = $conn->prepare("INSERT INTO `users` (`user_name`, `password`, `email`, `name`) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $uname, $hashed_password, $email, $name);

                if ($stmt->execute()) {
                    header("Location: ../index.php");

                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
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
            <form action="" method="POST">
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
                    <button class="btn-text" type="button" onclick="location.href='../index.php';">Already have an
                        account?</button>
                    <button class="btn-text" type="submit" name="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>