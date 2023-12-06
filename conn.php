<?php

$conn = new mysqli('localhost', 'u488180748_BatsCT5PE5', 'BatsCT5PE5', 'u488180748_BatsCT5PE5');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>