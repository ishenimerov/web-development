<?php
include_once "db-conn/db_conn.php";

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Perform deletion
    $deleteSql = "DELETE FROM `users` WHERE `id`='$user_id'";
    $deleteResult = $conn->query($deleteSql);

    if ($deleteResult) {
        // Deletion successful, redirect to users.php
        header('Location: users.php');
        exit();
    } else {
        // Error in deletion
        echo "Error deleting user: " . $conn->error;
    }
} else {
    // No user ID specified
    echo "No user ID specified.";
}