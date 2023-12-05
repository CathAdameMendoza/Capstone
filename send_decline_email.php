<?php

// Include mailer.php and initialize $mail as before
$mail = require __DIR__ . "/mailer.php";

// Function to sanitize and validate email
function sanitizeEmail($input)
{
    return filter_var($input, FILTER_SANITIZE_EMAIL);
}

// Function to sanitize and validate text input
function sanitizeText($input)
{
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a database connection
$conn = new mysqli($databaseHost, $databaseUsername,$databasePassword,$dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and remark from POST data
$email = isset($_POST["email"]) ? sanitizeEmail($_POST["email"]) : '';
$remark = isset($_POST["remark"]) ? sanitizeText($_POST["remark"]) : '';

// Set the email parameters for decline email
$mail->setFrom("no-reply@gmail.com");
$mail->addAddress($email);
$mail->Subject = "Notification of SPES Application Status";

// Email body content for decline email
$mail->Body = <<<END
    <!DOCTYPE html>
    <html>
    <head>
        <!-- Inline CSS styles -->
        <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        header {
            border-radius: 15px 15px 0 0;
            background-color: #383c54;
            color: #fff;
            padding: 10px 20px;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        footer {
            border-radius: 0 0 15px 15px;
            background-color: transparent;
            color: #fff;
            padding: 20px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #ffffff;
        }
        p {
            color: #555;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #383c54;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0b6e9c;
        }
        footer p {
            margin: 5px 0;
        }
        footer p.subtitle {
            font-weight: lighter;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <header>
                <center><h2>SPES-Batangas City</h2></center>
            </header>
            <br><br>
            <h1>Application Declined</h1>
            <p>
                We regret to inform you that after careful consideration, your SPES (Special Program for Employment of Students) application has been declined. 
                We appreciate your interest and effort in applying for the program. We wish you the best in your future endeavors and thank you for considering the SPES program.
            </p>
            <p>Remarks: <br> $remark <br> We encourage you to continue seeking opportunities that align with your skills and qualifications.</p>
            <br>
            <footer>
                <center>
                    <div class="#">
                        <img src="spes_logo.png" class="img-fluid" style="width: 50px !important;">
                        <img src="dole-logo.png" class="img-fluid" style="width: 50px !important;">
                    </div>
                </center>
                <p style="font-weight: bolder; font-size: 20px;">SPES-Batangas City</p>
                <p class="subtitle">Copyright © 2023 SPES. All Rights Reserved</p>
            </footer>
        </div>
    </body>
    </html>
END;


try {
    // Send the decline email
    $mail->send();

    // Update the remarks column in the database
    $updateQuery = "UPDATE applicants SET remarks = ?, status = 'Declined' WHERE email = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $remark, $email);
    $stmt->execute();
    $stmt->close();

    echo 'alert("Decline email sent successfully.");';
} catch (Exception $e) {
    // Handle email sending failure
    echo 'alert("Message could not be sent. Please try again later.");';
    // Log the error to a file or database for debugging
    error_log('Decline Email error: ' . $e->getMessage(), 0);
}

// Close the database connection
$conn->close();
?>
