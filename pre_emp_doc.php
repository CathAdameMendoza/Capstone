<?php
session_start();

// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a database connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Initialize the $uploadResults array
$uploadResults = [
    'school_id_photo' => [],
    'birth_certificate' => [],
    'e_signature' => [],
    'photo_grades' => [],
    'photo_itr' => [],
];

// Function to calculate image variance
function imageVariance($image)
{
    $width = imagesx($image);
    $height = imagesy($image);
    $sum = 0;
    $sumSquared = 0;

    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $sum += $r + $g + $b;
            $sumSquared += ($r * $r) + ($g * $g) + ($b * $b);
        }
    }

    $mean = $sum / ($width * $height);
    $variance = ($sumSquared / ($width * $height)) - ($mean * $mean);

    return $variance;
}

// Function to check if an image is blurred
function isImageBlurred($filePath, $threshold = 100)
{
    if (file_exists($filePath)) {
        // Check the image type and use the appropriate function (e.g., imagecreatefromjpeg, imagecreatefrompng)
        $imageInfo = getimagesize($filePath);

        if ($imageInfo !== false) {
            $image = false; // Initialize the image variable

            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $image = @imagecreatefromjpeg($filePath);
                    if (!$image) {
                        trigger_error("Failed to create image from JPEG", E_USER_ERROR);
                    }
                    break;
                case IMAGETYPE_PNG:
                    $image = @imagecreatefrompng($filePath);
                    if (!$image) {
                        trigger_error("Failed to create image from PNG", E_USER_ERROR);
                    }
                    break;
                default:
                    // Unsupported image type
                    return false; // Return false for unsupported types
            }

            if ($image !== false) {
                // The rest of your image processing code
                // ...
            }
        } else {
            trigger_error("Failed to get image info", E_USER_ERROR);
        }
    } else {
        trigger_error("Image file does not exist", E_USER_ERROR);
    }

    return false; // Unable to process the image
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the target directory for file uploads
    $targetDirectory = "uploads/";

    // Check if the uploaded files are in the expected format
    $expectedFields = ['school_id_photo', 'birth_certificate', 'e_signature', 'photo_grades', 'photo_itr'];

    $uploadErrors = [];

    foreach ($expectedFields as $fieldName) {
        if (isset($_FILES[$fieldName])) {
            if (is_array($_FILES[$fieldName]['tmp_name'])) {
                foreach ($_FILES[$fieldName]['tmp_name'] as $index => $tmp_name) {
                    if ($_FILES[$fieldName]['error'][$index] === UPLOAD_ERR_OK) {
                        $originalName = $_FILES[$fieldName]['name'][$index];
                        $targetFile = $targetDirectory . uniqid() . "_" . basename($originalName);

                        // Check if the file upload was successful
                        if (move_uploaded_file($tmp_name, $targetFile)) {
                            // Check if the image is blurred before storing the file path
                            if (isImageBlurred($targetFile)) {
                                $uploadResults[$fieldName][$index] = "Image is blurred.";
                            } else {
                                $uploadResults[$fieldName][$index] = $targetFile; // Store the file path in the array
                            }
                        } else {
                            $uploadErrors[] = "File upload failed for $fieldName.";
                        }
                    } else {
                        $uploadErrors[] = "File upload failed for $fieldName with error code: " . $_FILES[$fieldName]['error'][$index];
                    }
                }
            }
        }
    }

    if (empty($uploadErrors)) {
        // All uploads were successful
        // Now, you can handle the database insertion as per your requirements

        // Check if user_id is set in the session
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO applicant_documents (user_id, school_id_photo, birth_certificate, e_signature, photo_grades, photo_itr) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind the parameters for the prepared statement
            $stmt->bind_param(
                "ssssss",
                $user_id,
                $uploadResults['school_id_photo'][0], // Use index 0 as an example; adjust as needed
                $uploadResults['birth_certificate'][0], // Use index 0 as an example; adjust as needed
                $uploadResults['e_signature'][0], // Use index 0 as an example; adjust as needed
                $uploadResults['photo_grades'][0], // Use index 0 as an example; adjust as needed
                $uploadResults['photo_itr'][0] // Use index 0 as an example; adjust as needed
            );

            if ($stmt->execute()) {
                // Data inserted successfully
                header("Location: submitted.php");
                exit; // Make sure to exit to prevent further script execution
            } else {
                // Error occurred while inserting data
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "User ID is not set in the session.";
        }
    } else {
        // Output any upload errors
        foreach ($uploadErrors as $error) {
            echo "Upload Error: $error<br>";
        }
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Applicant Home Page</title>
    <link href="bootstrap.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <script src="jquery.js"></script>
    <script src="parsley.js"></script>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
    <style>
        body {
            font-family: "Century Gothic", sans-serif;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="spes_logo.png" alt="photo" class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome, <br>Applicant</br></span>
                        <h2></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br/>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="c">
                    <div class="menu_section">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        <h3>SPES Applicant Menu</h3>
                        <ul class="nav side-menu">
                            <li><a id="menu_toggle"><i class="fa fa-bars"></i> My Profile</a>
                            <li><a id="menu_toggle"><i class="fa fa-bars"></i> Required Docs. </a>
                            <li><a id="menu_toggle"><i class="fa fa-bars"></i> Submitted. </a>
   
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<!-- /top navigation -->
<div id="mainTopNav" class="top_nav">

<div class="nav_menu">
    <nav>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
        </ul>
    </nav>
</div>
</div>
<!-- /top navigation -->

<div id="loader"></div>

<!-- page content -->
<div id="mainContent2" class="right_col" role="main">

<!-- page content -->
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><small>Please upload required files</small></h2>
                <div class="separator my-10"></div>
                <div class="clearfix"></div> <br>
            </div>
            <div class="x_content">
                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <b>Warning!</b> You cannot make any changes to these documents once your application is approved.
                </div>

                <div class="separator my-10"></div>

                <div hidden id="alertMessage" class="alert alert-success alert-dismissible fade in"><i class="glyphicon glyphicon-question-sign"></i> </div>
                <form id="formPhoto" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data" action="pre_emp_doc.php">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_id">School ID (Scanned Image):<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="school_id_photo[]" id="photo_id" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        <br>
                        </div>
                        <div id="uploaded_image_school_id" class="col-md-3 col-sm-6 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_birthcert">Birth Certificate/Gov. issued ID (PDF File / Scanned Image):<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="birth_certificate" id="photo_birthcert" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        </div>
                        <div id="uploaded_image_birth_cert" class="col-md-3 col-sm-6 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_esign"> 3E-Signature (Scanned Image):<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="e_signature" id="photo_esign" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        </div>
                        <div id="uploaded_image_signature" class="col-md-3 col-sm-6 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_grades">Grades/Cert. OSY:<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="photo_grades" id="photo_grades" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        </div>
                        <div id="uploaded_image_grades" class="col-md-3 col-sm-6 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_itr">ITR/Cert. Indigency:<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="photo_itr" id="photo_itr" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        </div>
                        <div id="uploaded_image_itr" class="col-md-3 col-sm-6 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <br>
                            <button class="btn btn-info" type="button" id="checkBlurButton">Check for Blurriness</button>
                            <br><br>
                            <button class="btn btn-primary" type="button" onclick="cancelEditProfile()">Cancel</button>
                            <button class="btn btn-warning" onclick="goBack()">Back</button>
                            <button class="btn btn-success" type="submit" name="next" id="submitFormButton">Submit</button>
                            <br><br><br><br><br><br><br><br>
                        </div>
                    </div>

                    </form>
                <p id="error-message"></p>

<script>

// Function to handle form submission
function submitForm() {
    // Perform any validation or checks here if needed

    // Submit the form
    document.getElementById("formPhoto").submit();
}

// Attach the submitForm function to the submit button's click event
document.getElementById("submitFormButton").addEventListener("click", submitForm);

// Function to navigate back to the previous page
function goBack() {
    window.location.href = "spes_profile.php";
}
</script>

<script>
// Function to check image blurriness
function checkImageBlurriness(fileInputId) {
    const uploadedImage = document.getElementById(fileInputId).files[0];

    if (uploadedImage) {
        const reader = new FileReader();

        reader.onload = async function (e) {
            if (await isImageBlurred(e.target.result, 100)) {
                alert("Image is blurred.");
            } else {
                alert("Image is not blurred.");
            }
        };

        reader.readAsDataURL(uploadedImage);
    } else {
        alert("No image uploaded for blur check.");
    }
}

// Attach the checkImageBlurriness function to the "Check for Blurriness" button
document.getElementById("checkBlurButton").addEventListener("click", function () {
    // Check all file inputs for image blurriness
    checkImageBlurriness("photo_id");
    checkImageBlurriness("photo_birthcert");
    checkImageBlurriness("photo_esign");
    checkImageBlurriness("photo_grades");
    checkImageBlurriness("photo_itr");
});
</script>

    <!-- footer content -->
    <footer id="mainFooter">
            &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES)
        </footer>
    <!-- /footer content -->
</div>
</div>

</body>
</html>
