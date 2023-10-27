<?php

$databaseHost = 'localhost';
$databaseUsername = 'u488180748_BatsCT5PE5';
$databasePassword = 'BatsCT5PE5';
$dbname = "u488180748_BatsCT5PE5";

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM applicants";
$result = $connOrders->query($sql);

?>