<?php
// ----------------------------------------------------
// 1. Set the Content-Type Header (CRUCIAL)
// This tells the client (browser/tool) that the response body is JSON
// ----------------------------------------------------
header('Content-Type: application/json');

// ----------------------------------------------------
// Database Configuration
// ----------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_experiment_db";

// Initialize data array
$response_data = [];
$status_code = 200; // Default success status

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If connection fails, set an error status and message
    $status_code = 500;
    $response_data = [
        'status' => 'error',
        'message' => 'Database connection failed.',
        'error_details' => $conn->connect_error
    ];
} else {
    // ----------------------------------------------------
    // 2. Fetch Data (Read Operation)
    // ----------------------------------------------------
    $sql = "SELECT p.id, p.title, p.content, p.created_at, u.name AS author_name 
            FROM posts p
            JOIN users u ON p.author_id = u.id
            ORDER BY p.created_at DESC";
    
    $result = $conn->query($sql);

    $posts = [];
    if ($result && $result->num_rows > 0) {
        // Fetch all rows into an associative array
        while($row = $result->fetch_assoc()) {
            // Convert MySQL timestamp string to a cleaner format if needed, though PHP handles strings fine
            $posts[] = $row;
        }
        $response_data = [
            'status' => 'success',
            'count' => count($posts),
            'data' => $posts
        ];
    } else {
        // No posts found
        $response_data = [
            'status' => 'success',
            'count' => 0,
            'data' => []
        ];
    }

    $conn->close();
}

// ----------------------------------------------------
// 3. Encode the array to JSON and output
// ----------------------------------------------------
// Set HTTP response code
http_response_code($status_code);

// Output the JSON string
echo json_encode($response_data, JSON_PRETTY_PRINT);
?>