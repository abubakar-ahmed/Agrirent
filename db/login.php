<?php
// db/login.php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();
    
    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $user_id;
            header('Location: ../templates/index.html');
            exit();
        } else {
            // Password is incorrect
            echo "Invalid credentials";
        }
    } else {
        // No user found with this email
        echo "No user found with this email";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
