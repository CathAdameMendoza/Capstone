<?php
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create 'users' table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    gname VARCHAR(255) NOT NULL,
    mname VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($createTableQuery) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve user inputs from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $last_Name = $_POST['last_Name'];
    $first_Name = $_POST['first_Name'];
    $middle_Name = $_POST['middle_Name'];
    $sex = $_POST['sex'];

    // Check if the email already exists
    $checkEmailQuery = "SELECT user_id FROM users WHERE email  = '$email'";
    $emailResult = $conn->query($checkEmailQuery);

    if ($emailResult->num_rows > 0) {
        echo '<script>alert("Error: Email already exists.");</script>';
    } else {
        // Prepare an SQL statement to insert user data into the database
        $sql = "INSERT INTO users (lname, gname, mname, email, gender, password, username) 
                VALUES ('$last_Name', '$first_Name', '$middle_Name', '$email', '$sex', '$password', '$username')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo '<script>show();</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>eSPES | Sign up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
    <link href="style.css" rel="stylesheet">

    <style>
                 body {
           
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
          
        }

        #myModal {
        display: none;
        position: fixed;
        z-index: 1;
        /* Updated background color to gray */
        background-color: #333855;
        width: 80%;
        max-width: 600px;
        margin: auto;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        border-radius: 8px;
        color: #fff;
    }

    #modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        margin-bottom: 15px;
    }

    p {
        color: #555;
        line-height: 1.6;
        margin-bottom: 15px;
    }

    #agreeBtn,
    #disagreeBtn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-right: 10px;
    }

    #agreeBtn:hover,
    #disagreeBtn:hover {
        background-color: #45a049;
    }

    #disagreeBtn {
        background-color: #ff3333; /* Red background color */
    }

    #disagreeBtn:hover {
        background-color: #cc0000; /* Darker red on hover */
    }
    .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .succ {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .close-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .close-btn:hover {
            background-color: #45a049;
        }
        .alert {
            display: none;
            color: #d9534f;
            font-size: 14px;
            margin-top: 2px;
            padding: 10px 0;
        }
    </style>
</head>     
<body data-new-gr-c-s-check-loaded="14.1121.0" data-gr-ext-installed="">

<div class="overlay" id="overlay">
    <div class="succ">
        <p>You have successfully registered for the SPES program.</p>
        <button class="close-btn" onclick="close()">Close</button>
    </div>
</div>
<script>
    // Function to show the modal
    function show() {
        var overlay = document.getElementById("overlay");
        overlay.style.display = "flex";
    }

    // Function to close the modal
    function close() {
        var overlay = document.getElementById("overlay");
        overlay.style.display = "none";
    }

    // Example: Show the modal on page load
    window.onload = function () {
        show();
    };
</script>

<!-- The Modal -->
<div id="myModal">
    <div id="modal-content">
        <h2>Terms and Conditions</h2>
        <!-- Include your terms and conditions text here -->
        <p>By using our services, you acknowledge and agree that we may collect and store personal information that you provide voluntarily. This information includes, but is not limited to, your name, contact details, and any other data necessary for the purpose of our services.</p>

        <p>We are committed to safeguarding your privacy and ensuring the security of your personal information. All data collected will be used solely for the purpose of providing and improving our services. Your information will not be shared with third parties unless explicitly consented by you or as required by law.</p>

        <p>We employ industry-standard security measures to protect the confidentiality and integrity of your personal information. However, please be aware that no method of transmission over the internet or electronic storage is entirely secure, and we cannot guarantee absolute security.</p>

        <p>By using our services, you consent to the collection, storage, and processing of your personal information as described in this statement. If you do not agree with these terms, please refrain from using our services.</p>

        <button id="agreeBtn">I Agree</button>
        <button id="disagreeBtn">Disagree</button>
    </div>
</div>
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
                            <form id="aep" method="post">
                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <img src="dole-logo.png" class="img-fluid" style="width: 100px !important;" alt="Phone image">
                                    <span class="h1 fw-bold mb-0">Register</span>
                                </div>
                                <p class="alert" id="alertMessage">Please enter only letters and numbers. Spaces and Special Characters are not allowed.</p>
                                <div class="input-box">
                                    <div class="icon"><i class="fas fa-user-alt trailing"></i></div>
                                    <input type="text" id="username" name="username"  oninput="validateInput(this)" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="username">Username</label>
                                   

                                </div>
                                
<script>
    function validateInput(inputField) {
        var alertMessage = document.getElementById("alertMessage");

        // Check for invalid characters using a regular expression
        if (/[^A-Za-z0-9]/.test(inputField.value)) {
            // Show the alert message
            alertMessage.style.display = "block";
        } else {
            // Hide the alert message
            alertMessage.style.display = "none";
        }
    }
</script>
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-lock trailing"></i></div>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <hr>
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-left trailing"></i></div>
                                    <input type="text" id="first_Name" name="first_Name" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="first_Name">First Name</label>
                                </div>
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-center trailing"></i></div>
                                    <input type="text" id="middle_Name" name="middle_Name" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="middle_Name">Middle Name</label>
                                </div>
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-right trailing"></i></div>
                                    <input type="text" id="last_Name" name="last_Name" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="last_Name">Last Name</label>
                                </div>
                                <div class="input-box">
                                    <div class="icon"><i class="fas fa-caret-down trailing"></i></div>
                                        <select id="sex" name="sex" class="required form-control form-control-lg border form-icon-trailing">
                                            <option value="" selected="" disabled="">Sex:</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    
                                </div>
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-envelope trailing"></i></div>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="email">Email Address</label>
                                </div>
                                
                                <!-- Submit button -->
                                <input type="submit" id="register_butt" class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" value="Sign Up">
                                <div class="pt-2"></div>
                                <div class="pt-1 mb-4">
                                    <div class="divider d-flex align-items-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-muted">Already Registered?</p>
                                    </div>
                                    <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="index.php" role="button">
                                        <i class="far fa-user me-2"></i>
                                        Sign In
                                    </a>
                                </div>
                                <div class="divider d-flex align-items-center my-4">
                                    <a href="#!" class="small text-muted">Copyright © 2023 SPES . All Rights Reserved</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modal and buttons
    var modal = document.getElementById("myModal");
    var closeBtn = document.getElementById("closeBtn");
    var agreeBtn = document.getElementById("agreeBtn");
    var disagreeBtn = document.getElementById("disagreeBtn");
    var myForm = document.getElementById("myForm");

    // Open the modal automatically on page load
    window.onload = function() {
        modal.style.display = "block";
    }

    // Close the modal and show the form when the user agrees
    agreeBtn.onclick = function() {
        modal.style.display = "none";
        myForm.style.display = "block";
    }

    // Close the modal without showing the form when the user disagrees
    disagreeBtn.onclick = function() {
        // Change the URL to the desired page
        window.location.href = "index.php";
    }

    // Close the modal if the user clicks outside of it or clicks the close button
    window.onclick = function(event) {
        if (event.target == modal || event.target == closeBtn) {
            modal.style.display = "none";
        }
    }
</script>
</body>

</html>
