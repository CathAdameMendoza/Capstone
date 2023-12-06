<?php
// Establish database connection
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_BatsCT5PE5';
$databasePassword = 'BatsCT5PE5';
$dbname = "u488180748_BatsCT5PE5";

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePasswor , $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['message'])) {
    $id = $_POST['id'];
    $message = $_POST['message'];

    $sql = "UPDATE applicants SET remarks = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $message, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Message inserted successfully!";
    } else {
        echo "Failed to insert message.";
    }
} else {
    echo "Invalid request!";
}

// Close the connection
$conn->close();
?>
