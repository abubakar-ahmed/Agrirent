<?php
session_start(); // Start a session

header('Content-Type: application/json');

// Include the database connection file
require './db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['comfirm_password'];




    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        
        // Redirect to index.html
        echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
        header('Location: ../templates/index.html');
        exit();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        header('Location: ../templates/index.html');
    }

    $stmt->close();
    $conn->close();
} else {
    // Not a POST request
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
    header('Location: ./index.html');
}
?>