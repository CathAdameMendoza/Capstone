<?php 
$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = new mysqli('localhost', 'root', '', 'spes_db');

if ($mysqli->connect_error) {
    die("Connection failed: " .$mysqli->connect_error);
} 

$sql = "UPDATE users
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("no-reply@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
    <!DOCTYPE html>
    <html>
    <head>
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
            <h1>Password Reset</h1>
            <p>
                You've requested to reset your password. Click the link below to reset it:
            </p>
            <br>
            <p>
                <a href="http://localhost/capstone/reset_password.php?token=$token" style="color:white;">Reset Password</a>
            </p>
            <footer>
                <center>
                <div class="#">
                    <img src="spes_logo.png" class="img-fluid" style="width: 50px !important;" >
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

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}
echo '<script type="text/javascript">';
echo 'alert("Message sent, please check your inbox.");';
echo 'window.location.href = "index.php";';
echo '</script>';

?>