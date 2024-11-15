<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "password_manager"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $website = $_POST["website"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($website && $username && $password) {
        $sql = "INSERT INTO passwords (website, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $website, $username, $password);

        if ($stmt->execute()) {
            echo "Password updated successfully!";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Invalid input data.";
    }
}

$conn->close();
?>
