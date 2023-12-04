<?php
session_start();

$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registration_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $suffix = $_POST['suffix'];
    $last_Name = $_POST['last_Name'];
    $first_Name = $_POST['first_Name'];
    $middle_Name = $_POST['middle_Name'];
    $sex = $_POST['sex'];

    //var_dump($username, $email, $password, $suffix, $last_Name, $first_Name, $middle_Name, $sex);


    $checkEmailQuery = "SELECT user_id FROM users WHERE email  = ?";
    $stmt = $conn->prepare($checkEmailQuery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $emailResult = $stmt->get_result();

    if ($emailResult->num_rows > 0) {
        echo '<script>
        Swal.fire({
            title: "Error!",
            text: "Email already exists.",
            icon: "error",
            confirmButtonText: "OK",
            customClass: {
                popup: "custom-modal",
                title: "alert-title",
                content: "alert-content",
                confirmButton: "alert-confirm-button"
            }
        });
        </script>';
        exit();
    } else {
        $insertQuery = "INSERT INTO users (suffix, lname, gname, mname, email, gender, password, username) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssssss", $suffix, $last_Name, $first_Name, $middle_Name, $email, $sex, $password, $username);
        
        if ($stmt->execute()) {
            $registration_successful = true;
            
            // Retrieve the inserted user ID
            $user_id = $stmt->insert_id;
        
            // Set the user_id directly in the session
            $_SESSION['user_id'] = $user_id;
        
            // Store other user data if needed in the session
            $_SESSION['user_data'] = array(
                'first_Name' => $first_Name,
                'middle_Name' => $middle_Name,
                'last_Name' => $last_Name,
                'suffix' => $suffix,
                'sex' => $sex,
                'email' => $email
            );
            header("Location: spes_profile.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    
    }
    $stmt->close();
}

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

    

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
    .alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    border-radius: 5px;
    position: fixed;
    bottom: 15px;
    right: 15px;
    display: none;
    z-index: 1;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
/* Square-shaped SweetAlert modal */
.swal2-popup {
            width: 30% !important;
            border-radius: 10px;
        }

        /* Increase font size */
        .swal2-title,
        .swal2-content,
        .swal2-confirm {
            font-size: 20px !important;
        }

        /* Increase button size */
        .swal2-confirm {
            padding: 12px 24px !important;
        }


    </style>
</head>     
<body data-new-gr-c-s-check-loaded="14.1121.0" data-gr-ext-installed="">

<div id="alertMessage" class="alert">
    <span class="closebtn" onclick="closeAlert()">&times;</span>
    Avoid Spacing on username!
</div>

<script>
    function showAndCloseAlert() {
        var alertMessage = document.getElementById("alertMessage");
        alertMessage.style.display = "block";
        setTimeout(function () {
            alertMessage.style.display = "none";
        }, 10000); // 10000 milliseconds = 10 seconds
    }

    function closeAlert() {
        var alertMessage = document.getElementById("alertMessage");
        alertMessage.style.display = "none";
    }

    // Example: Show the alert message on page load
    window.onload = function () {
        showAndCloseAlert();
    };
</script>

<script>
    function showMessageAndRedirect(title, text, icon, redirectUrl) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonText: 'OK',
            customClass: {
                title: 'alert-title',
                content: 'alert-content',
                confirmButton: 'alert-confirm-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to another page
                window.location.href = 'spes_profile.php';
            }
        });
    }

    // Assume you have a variable 'uploadSuccess' that indicates whether the upload was successful
    var uploadSuccess = true; // Replace this with your actual logic

    // Function to handle button click
    function handleButtonClick() {
        // Check if the data was uploaded successfully
        if (uploadSuccess) {
            // Call the showMessageAndRedirect function
            showMessageAndRedirect('Registration Successful', 'Your registration data has been uploaded successfully!', 'success', 'anotherPage.html');
        } else {
            // Call the showMessageAndRedirect function with an error message
            showMessageAndRedirect('Error', 'Failed to upload data. Please try again.', 'error', 'originalPage.html');
        }
    }
</script>



<!-- The Modal -->

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
                                <p class="alert" id="alertMessage2">Please enter only letters and numbers. Spaces and Special Characters are not allowed.</p>
                                <div class="input-box">
                                    <div class="icon"><i class="fas fa-user-alt trailing"></i></div>
                                    <input type="text" id="username" name="username"  oninput="validateInput(this)" class="form-control form-control-lg border form-icon-trailing" required="">
                                    <label class="form-label" for="username">Username</label>
                                   

                                </div>
                                
<script>
    function validateInput(inputField) {
        var alertMessage2 = document.getElementById("alertMessage2");

        // Check for invalid characters using a regular expression
        if (/[^A-Za-z0-9]/.test(inputField.value)) {
            // Show the alert message
            alertMessage2.style.display = "block";
        } else {
            // Hide the alert message
            alertMessage2.style.display = "none";
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
                                    <input type="text" id="first_Name" name="first_Name" class="form-control form-control-lg border form-icon-trailing" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed"required>
                                    <label class="form-label" for="first_Name">First Name</label>
                                </div>

                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-center trailing"></i></div>
                                    <input type="text" id="middle_Name" name="middle_Name" class="form-control form-control-lg border form-icon-trailing" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed">
                                    <label class="form-label" for="middle_Name">Middle Name</label>
                                </div>

                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-right trailing"></i></div>
                                    <input type="text" id="last_Name" name="last_Name" class="form-control form-control-lg border form-icon-trailing" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" required>
                                    <label class="form-label" for="last_Name">Last Name</label>
                                </div>
                                
                                <div class="input-box">
                                <div class="icon"><i class="fas fa-align-right trailing"></i></div>
                                    <input type="text" id="suffix" name="suffix" class="form-control form-control-lg border form-icon-trailing" required pattern="[A-Za-z\s]+" title="Only letters and spaces are allowed" >
                                    <label class="form-label" for="suffix">Suffix</label>
                                </div>

                                <div class="input-box">
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control form-control-lg border form-icon-trailing" >
                                    <label class="form-label" for="date_of_birth">Date of Birth</label>
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
                                <input type="submit" id="register_butt" class="btn btn-primary btn-lg btn-block" onclick="handleButtonClick()" style="background-color: #3b5998" value="Sign Up">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include SweetAlert library -->

<script>
    $(document).ready(function() {
        $('#date_of_birth').on('change', function() {
            var dob = new Date($(this).val());
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();

            // Check if age is within the range of 18 to 30
            if (age < 18 || age > 30) {
                // Display SweetAlert message
                showMessage('Age Restriction', 'Age must be between 18 to 30 years old.', 'error');
                $(this).val(''); // Clear the input if age is not within the range
            }
        });

        // Function to display SweetAlert message
        function showMessage(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    content: 'alert-content',
                    confirmButton: 'alert-confirm-button'
                }
            });
        }
        
    });
</script>



</body>

</html>
