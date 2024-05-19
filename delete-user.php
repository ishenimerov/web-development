<?php
include_once "db-conn/db_conn.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Check if the user exists
    $sql = "SELECT * FROM `users` WHERE `id`='$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, display confirmation
        echo "<script>
                var confirmDelete = confirm('Are you sure you want to delete this user?');

                if (confirmDelete) {
                    // User confirmed deletion, perform deletion
                    window.location.href = 'deleteUser.php?id=$user_id';
                } else {
                    // User canceled deletion, redirect to users.php
                    window.location.href = 'users.php';
                }
              </script>";
    } else {
        // User does not exist
        echo "User not found.";
    }
} else {
    // No user ID specified
    echo "No user ID specified.";
}