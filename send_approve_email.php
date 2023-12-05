<?php 
    $mail = require __DIR__ . "/mailer.php";
    $email = isset($_POST["email"]) ? $_POST["email"] : '';

    $mail->setFrom("no-reply@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Notification of SPES Application Status";
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
            <h1>Congratulations! Your SPES Application has been Approved</h1>
            <p>
            We are thrilled to inform you that your application for the Special Program for Employment of Students (SPES) has been approved!
            Congratulations on this significant achievement.
            <br><br>
            Your qualifications and enthusiasm stood out among the applicants, and we believe you will contribute immensely to the program. 
            This opportunity will not only provide valuable work experience but also support your educational journey.
            <br><br>
            Please visit our office for orientation. We're excited to have you on board!
            <br><br>
            Once again, congratulations on your approval, and we look forward to your participation in the SPES program.
            </p>
            <br>

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


echo '<script type="text/javascript">';
echo 'alert("Message sent, please check your inbox.");';
echo 'window.location.href = "http://localhost/capstone/index.php";';
echo '</script>';

?>