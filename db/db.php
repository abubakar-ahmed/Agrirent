<?php
$servername = "localhost";
$username = "root";  
$password = "Abubakarahmed06";     
$dbname = "login_sample_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

//stripe.api_key = "sk_test_51PhsluRo7zM6zhaNepKTNta9O6SgAI8Fa1HRzOmHwGd66fkJRxhubApiPaEGgAF3acuGZjWP4a27JTOOHiRr4mYF00opfjmjlT"
//$conn->close();
?>
