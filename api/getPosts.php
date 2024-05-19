<?php
header('Content-Type: application/json');
include "../db-conn/db_conn.php";
session_start();

$user_id = $_SESSION['id'];
$is_home_page = isset($_GET['home']) && $_GET['home'] == '1';

// Determine the SQL query based on the page context
if ($is_home_page) {
    // Query to retrieve all posts
    $sql = "SELECT * FROM posts";
} else {
    // Query to retrieve posts for the current user
    $sql = "SELECT * FROM posts WHERE user_id=?";
}

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    $response = array('error' => 'Failed to prepare the SQL statement: ' . $conn->error);
    http_response_code(500); // Internal Server Error
    echo json_encode($response);
    exit(); // Terminate the script
}

if (!$is_home_page) {
    // Bind the user_id parameter if not on the home page
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

// Check if the query was successful
if (!$result) {
    $response = array('error' => 'Database error: ' . $stmt->error);
    http_response_code(500); // Internal Server Error
    echo json_encode($response);
    exit(); // Terminate the script
} else {
    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch all rows and store them in an array
        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        // Convert the array to JSON and echo it
        echo json_encode($posts);
    } else {
        // If no posts are found, echo a JSON response with an empty array
        echo json_encode(array());
    }
}

// Close the statement and the connection
$stmt->close();
$conn->close();
