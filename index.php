<?php
include 'createdb.php';
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'spes_db';

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the username and password match a record in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // You should perform proper validation and sanitization here

    $sql = "SELECT user_id FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login, redirect to a dashboard page
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        // Use JavaScript to display an alert and then redirect
        echo '<script>alert("Login successful. Click OK to proceed to the home page.");
              window.location.href = "spes_profile.php";</script>';
        exit();
    }else{
        $sql = "SELECT user_id FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Successful login, redirect to a dashboard page
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];

        // Use JavaScript to display an alert and then redirect
        echo '<script>alert("Admin Login successful. Click OK to proceed to the home page.");
              window.location.href = "admin_homepage.php";</script>';
        exit();
    } else {
        echo '<script>alert("Invalid email or password.");</script>';
    }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Online Special Program for Employment of Student">
    <meta name="keywords" content="Online SPES, DOLE, Department of Labor and Employment">
    <title>eSPES | Please Sign in</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
            <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block position-relative">
                        <div class="position-absolute top-50 start-50 translate-middle" style="width: 500px !important; margin-left: 70px !important">
                            <img src="spes_logo.png" class="img-fluid" alt="SPES Logo">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <div class="d-flex align-items-center mb-3 pb-1">
                                <img src="dole-logo.png" class="img-fluid" style="width: 100px !important;" alt="Phone image">
                                <span class="h1 fw-bold mb-0">Log In</span>
                            </div>
                            <!-- Login form -->
                            <form method="POST">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <i class="fas fa-user-alt trailing"></i>
                                    <input type="text" id="email" name="email" class="form-control form-control-lg border form-icon-trailing" required>
                                    <label class="form-label" for="email">Username</label>
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <i class="fas fa-lock trailing"></i>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg border form-icon-trailing" required>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="d-flex justify-content-around align-items-center mb-4">
                                    Forgot password?
                                </div>
                                <!-- Submit button -->
                                <button class="btn btn-primary btn-lg btn-block" type="submit" style="background-color: #1054d4">
                                    Login
                                </button>
                                <div class="pt-2"> </div>
                                <div class="pt-1 mb-4">
                                    <div class="divider d-flex align-items-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                                    </div>
                                    <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="signup.php" role="button">
                                        <i class="far fa-user me-2"></i> Register
                                    </a>
                                    <div class="divider d-flex align-items-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-muted">USER MANUAL</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mx-auto">
                                            <a class="btn btn-primary btn-lg btn-block" style="background-color: #3A8891" href="#" target="_blank" role="button">
                                                <i class="far fa-user me-2"></i>
                                                FOR SPES APPLICANTS
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0 text-muted">Copyright © 2023 SPES. All Rights Reserved</p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
