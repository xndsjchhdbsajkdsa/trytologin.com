<?php
$host = 'localhost'; 
$username = 'jhosua'; 
$password = 'dodot22671';
$database = 'simple_login'; 

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statements for security
$stmt = $conn->prepare("SELECT * FROM user_info WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<div style='color: green; text-align: center; font-size: 50px; font-weight: bold;'>Login successful!</div>";
} else {
    echo "<div style='color: green; text-align: center; font-size: 50px; font-weight: bold;'>Invalid username or password.</div>";
}

// Close connections
$stmt->close();
$conn->close();
?>
