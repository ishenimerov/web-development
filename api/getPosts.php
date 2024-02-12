<?php
// header('Content-Type: application/json');
include "../db-conn/db_conn.php";

// Query to retrieve all posts
$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    $response = array('error' => 'Database error: ' . $conn->error);
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
        echo "<script>console.log(" . $jsonResponse . ")</script>";
    } else {
        // If no posts are found, echo a JSON response with an empty array
        echo json_encode(array());
    }
}

// Close the connection
$conn->close();
