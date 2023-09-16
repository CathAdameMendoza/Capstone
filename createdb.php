<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating database: " . $conn->error;
    exit();
}

// Connect to the newly created database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Create the users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    unique_id VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    gname VARCHAR(255) NOT NULL,
    mname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table 'users': " . $conn->error;
    exit();
}

// Create the admin table
$sql = "CREATE TABLE IF NOT EXISTS admin(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table: " . $conn->error;
}


// Define the username and password you want to insert
$username = "admin";
$password = "admin";

// Check if the username already exists
$check_query = "SELECT username FROM admin WHERE username = '$username'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows == 0) {
    // The username doesn't exist, so insert it
    $insert_query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";

    if ($conn->query($insert_query) === TRUE) {
        echo " ";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>