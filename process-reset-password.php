<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);
$mysqli = new mysqli('localhost', 'root', '', 'spes_db');

if ($mysqli->connect_error) {
    die("Connection failed: " .$mysqli->connect_error);
} 


$sql = "SELECT * FROM users
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash =$_POST["password"];

$sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["user_id"]);

$stmt->execute();
echo "<script language='javascript'> alert('Password updated. You can now login'); 
		window.location='index.php';</script>";