<?php
header('Content-Type: application/json');
include("../db-conn/db_conn.php");

// Check if 'user_id' is provided in the query parameters
if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    // Query to retrieve the name based on user_id
    $sql = "SELECT name FROM users WHERE id = ?"; // Use 'id' instead of 'user_id'
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Return an error message if the statement could not be prepared
        echo json_encode(['error' => 'Database error: ' . $conn->error]);
    } else {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($name);

        // Check if the query was successful
        if ($stmt->fetch()) {
            // Return the name as JSON
            echo json_encode(['name' => $name]);
        } else {
            // Return an error message if user not found
            echo json_encode(['error' => 'User not found']);
        }

        $stmt->close();
    }
} else {
    // Return an error message if 'user_id' is not provided
    echo json_encode(['error' => 'User ID not provided']);
}

// Close the database connection
$conn->close();
