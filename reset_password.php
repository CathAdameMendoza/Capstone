<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);


$mysqli = new mysqli('localhost', 'u488180748_BatsCT5PE5', 'BatsCT5PE5', 'u488180748_BatsCT5PE5');

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.1.0/mdb.min.js"></script>
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
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
                                <span class="h1 fw-bold mb-0">Reset Password</span>
                            </div>
                            <!-- Login form -->
                            <form action="process-reset-password.php" method="POST" class="login-form">
                                    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                                    <div class="input-box">
                                        <div class="icon"><i class="fas fa-lock"></i></div>
                                        <input name="password" id="password"type="password"  class="form-control form-control-lg border form-icon-trailing" required>
                                        <label class="form-label" for="email">New Password </label>
                                    </div>
                                    <div class="input-box">
                                        <div class="icon"><i class="fas fa-lock"></i></div>
                                        <input id="password_confirmation" name="password_confirmation"type="password"class="form-control form-control-lg border form-icon-trailing" required>
                                        <label class="form-label" for="email">Re-enter New Password </label>
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" ><i class="fas fa-paper-plane"></i>  Send Email</button>
                                    <div class="login-register"> 
                                        <br>
                                    <p class="text-center fw-bold mx-3 mb-0 text-muted">Copyright © 2023 SPES. All Rights Reserved</p>
                                        </p> 
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
