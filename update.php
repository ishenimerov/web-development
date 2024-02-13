<?php

include "db-conn/db_conn.php";

// Function to check if a username already exists in the database
function checkUsernameExists($conn, $username, $user_id)
{
    $sql = "SELECT * FROM `users` WHERE `user_name`='$username' AND `id` <> '$user_id'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

// Function to check if an email already exists in the database
function checkEmailExists($conn, $email, $user_id)
{
    $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `id` <> '$user_id'";
    $result = $conn->query($sql);
    return ($result->num_rows > 0);
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT * FROM `users` WHERE `id`='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $username = $row['user_name'];
            $name = $row['name'];
            $email = $row['email'];
        }
    } else {
        header('Location: users.php');
    }

    $usernameError = "";
    $emailError = "";
    $updateSuccess = false;

    if (isset($_POST['update'])) {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Validate username and email
        $usernameExists = checkUsernameExists($conn, $username, $user_id);
        $emailExists = checkEmailExists($conn, $email, $user_id);

        if ($usernameExists) {
            $usernameError = "Error: Username already exists.";
        }

        if ($emailExists) {
            $emailError = "Error: Email already exists.";
        }

        if (!$usernameExists && !$emailExists) {
            // Update the record
            $sql = "UPDATE `users` SET `user_name`='$username', `name`='$name', `email`='$email' WHERE `id`='$user_id'";

            $result = $conn->query($sql);

            if ($result == TRUE) {
                $updateSuccess = true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
} else {
    header('Location: users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/style.css">
    <title>User Update Form</title>

</head>

<body>
    <div class='wrapper'>
        <?php include "common/header/header.php"; ?>
        <div class="container">
            <div class='form-box'>

                <h2>User Update Form</h2>

                <?php if ($updateSuccess): ?>
                    <span class="success-message">Record updated successfully.<br /> Redirecting to users page...</span>
                    <?php header("refresh:2;url=users.php"); ?>
                <?php else: ?>
                    <form action="" method="post">
                        <label for="username">Username:</label>
                        <input type="text" name="username" value="<?php echo $username; ?>" required>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <?php if (!empty($usernameError)): ?>
                            <span class="error">
                                <?php echo $usernameError; ?>
                            </span>
                        <?php endif; ?>

                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo $name; ?>" required>

                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo $email; ?>" required>
                        <?php if (!empty($emailError)): ?>
                            <span class="error">
                                <?php echo $emailError; ?>
                            </span>
                        <?php endif; ?>
                        <div class='form-actions-box'>
                            <button class="btn-text" type="submit" name="update">Update</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'common/footer/footer.php'; ?>
</body>

</html>