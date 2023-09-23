<?php
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'spes_db';

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
$sql = "CREATE TABLE applicant_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filetype VARCHAR(100) NOT NULL,
    filedata LONGBLOB NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

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
$sql = "CREATE TABLE IF NOT EXISTS  applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_Name VARCHAR(255) NOT NULL,
    middle_Name VARCHAR(255),
    last_Name VARCHAR(255) NOT NULL,
    birthday DATE NOT NULL,
    place_of_birth VARCHAR(255) NOT NULL,
    citizenship VARCHAR(255) NOT NULL,
    mobile_no VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    civil_status INT NOT NULL,
    sex VARCHAR(10) NOT NULL,
    spes_type INT NOT NULL,
    parent_status INT NOT NULL,
    parents_displaced INT NOT NULL,
    no_street VARCHAR(255) NOT NULL,
    province_id INT NOT NULL,
    city_municipality_id INT NOT NULL,
    barangay_id INT NOT NULL,
    no_street2 VARCHAR(255) NOT NULL,
    province_id2 INT NOT NULL,
    city_municipality_id2 INT NOT NULL,
    barangay_id2 INT NOT NULL,
    father_first_name VARCHAR(255) NOT NULL,
    father_middle_name VARCHAR(255),
    father_last_name VARCHAR(255) NOT NULL,
    father_contact_no VARCHAR(15) NOT NULL,
    mother_first_name VARCHAR(255) NOT NULL,
    mother_middle_name VARCHAR(255),
    mother_last_name VARCHAR(255) NOT NULL,
    mother_contact_no VARCHAR(15),
    elem_name VARCHAR(255) NOT NULL,
    elem_degree VARCHAR(255),
    year_grade_level INT,
    elem_date_attendance VARCHAR(20),
    hs_name VARCHAR(255),
    hs_degree VARCHAR(255) NOT NULL,
    hs_year_level INT NOT NULL,
    hs_date_attendance VARCHAR(20),
    suc_name VARCHAR(255),
    suc_course VARCHAR(255),
    suc_year_level INT,
    suc_date_attendance VARCHAR(20),
    status VARCHAR(20),
    spes_times INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error creating table 'applicants': " . $conn->error;
    exit();
}
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