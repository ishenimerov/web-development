<?php
session_start();
include "../db-conn/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {
    $uname = htmlspecialchars($_POST['uname']);
    $pass = htmlspecialchars($_POST['password']);

    if (empty($uname) || empty($pass)) {
        header("Location: ../index.php?error=Username and password are required");
        exit();
    }

    $sql = "SELECT * FROM users WHERE user_name=?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../home.php");
                    exit();
                } else {
                    header("Location: ../index.php?error=Incorrect password");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=Incorrect username");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Query failed");
            exit();
        }
    } else {
        header("Location: ../index.php?error=Prepared statement failed");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}