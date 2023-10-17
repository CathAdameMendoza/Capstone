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
    'school_id_photo' => null,
    'birth_certificate' => null,
    'e_signature' => null,
    'photo_grades' => null,
    'photo_itr' => null
];

// Function to check if an image is blurred
function isImageBlurred($filePath, $threshold = 100)
{
    if (file_exists($filePath)) {
        // Check the image type and use the appropriate function (e.g., imagecreatefromjpeg, imagecreatefrompng)
        $imageInfo = getimagesize($filePath);

        if ($imageInfo !== false) {
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($filePath);
                    break;
                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($filePath);
                    break;
                default:
                    $image = false;
            }

            if ($image !== false) {
                $laplacian = imageconvolution($image, array(
                    array(-1, -1, -1),
                    array(-1, 8, -1),
                    array(-1, -1, -1)
                ), 1, 0);

                $variance = imagevariance($laplacian);

                imagedestroy($image);

                return $variance < $threshold;
            }
        }
    }

    return false; // Unable to process the image
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the target directory for file uploads
    $targetDirectory = "uploads/";

    // Loop through the uploaded files
    foreach ($_FILES as $fieldName => $file) {
        $targetFile = $targetDirectory . uniqid() . "_" . basename($file["name"]);

        // Check if the file upload was successful
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Upload the file to the server
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                // Check if the image is blurred before storing the file path
                if (isImageBlurred($targetFile)) {
                    $uploadResults[$fieldName] = "Image is blurred.";
                } else {
                    $uploadResults[$fieldName] = $targetFile; // Store the file path in the array
                }
            } else {
                $uploadResults[$fieldName] = "File upload failed.";
            }
        } else {
            $uploadResults[$fieldName] = "File upload failed with error code: " . $file['error'];
        }
    }

    // Now, you can handle the database insertion as per your requirements
    // Include the 'user_id' in the INSERT statement
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO applicant_documents (user_id, school_id_photo, birth_certificate, e_signature, photo_grades, photo_itr) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if each file path exists in the uploadResults array before binding
    if (
        isset($uploadResults['school_id_photo']) &&
        isset($uploadResults['birth_certificate']) &&
        isset($uploadResults['e_signature']) &&
        isset($uploadResults['photo_grades']) &&
        isset($uploadResults['photo_itr'])
    ) {
        $stmt->bind_param(
            "ssssss",
            $user_id,
            $uploadResults['school_id_photo'],
            $uploadResults['birth_certificate'],
            $uploadResults['e_signature'],
            $uploadResults['photo_grades'],
            $uploadResults['photo_itr']
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
        echo "File paths are missing in the uploadResults array.";
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
                <form id="formPhoto" data-parsley-validate class="form-horizontal form-label-left" method="POST" 
                    enctype="multipart/form-data" onsubmit="return validateForm()" action="pre_emp_doc.php">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo_id">School ID (Scanned Image):<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                        <input type="file" name="school_id_photo" id="photo_id" style="margin-top: 7px;" accept=".jpg,.jpeg,.png,.pdf" />
                        <br>
                        <input type="submit" name="submit" value="Upload">
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
                            <button class="btn btn-primary" type="button" id="uploadButton">Upload Image</button>
                            <button class="btn btn-info" type="button" id="checkBlurButton">Check for Blur</button>
                            <br><br>
                            <button class="btn btn-primary" type="button" onclick="cancelEditProfile()">Cancel</button>
                            <button class="btn btn-warning" onclick="goBack()">Back</button>
                            <button class="btn btn-success" type="submit" name="next">Submit</button>
                            <br><br><br><br><br><br><br><br>
                        </div>
                    </div>
                </form>
<p id="error-message"></p>

    <script>
        function validateForm() {
            var errorMessages = [];
            
            // Array of file input elements
            var fileInputs = document.querySelectorAll('input[type="file"]');
            
            for (var i = 0; i < fileInputs.length; i++) {
                var fileInput = fileInputs[i];
                var errorMessage = document.getElementById("error-message");

                // Check if a file is selected for this input
                if (!fileInput.files.length) {
                    errorMessages.push("Please select a file for " + fileInput.name);
                }

                var file = fileInput.files[0];
                var fileSize = file.size; // Size in bytes
                var fileType = file.type; // MIME type

                // Check file type for images and PDF
                if (fileType !== 'image/jpeg' && fileType !== 'image/jpg' && fileType !== 'image/png' && fileType !== 'application/pdf') {
                    errorMessages.push("Only JPEG, PNG, and PDF files are allowed for " + fileInput.name);
                }

                // Check file size for images (between 5MB and 20MB)
                if (fileType !== 'application/pdf') {
                    var minSize = 5 * 1024 * 1024; // 5MB in bytes
                    var maxSize = 20 * 1024 * 1024; // 20MB in bytes
                    if (fileSize < minSize || fileSize > maxSize) {
                        errorMessages.push("Image file size must be between 5MB and 20MB for " + fileInput.name);
                    }
                }
            }

            var errorMessage = document.getElementById("error-message");
            if (errorMessages.length > 0) {
                errorMessage.innerText = errorMessages.join("\n");
                return false;
            }

            errorMessage.innerText = "";
            return true;
        }
    </script>

            </div>
        </div>
    </div>
</div>
</div>


<script>
        function validateForm() {
            var fileInput = document.getElementById("file");
            var errorMessage = document.getElementById("error-message");

            // Check if a file is selected
            if (!fileInput.files.length) {
                errorMessage.innerText = "Please select a file.";
                return false;
            }

            var file = fileInput.files[0];
            var fileSize = file.size; // Size in bytes
            var fileType = file.type; // MIME type

            // Check file type
            if (fileType !== 'image/jpeg' && fileType !== 'image/jpg' && fileType !== 'image/png') {
                errorMessage.innerText = "Only JPEG and PNG files are allowed.";
                return false;
            }

            // Check file size (between 5MB and 20MB)
            var minSize = 5 * 1024 * 1024; // 5MB in bytes
            var maxSize = 20 * 1024 * 1024; // 20MB in bytes
            if (fileSize < minSize || fileSize > maxSize) {
                errorMessage.innerText = "File size must be between 5MB and 20MB.";
                return false;
            }

            errorMessage.innerText = "";
            return true;
        }
    </script>

<script>
    document.getElementById("checkBlurButton").addEventListener("click", async function () {
        const uploadedImage = document.getElementById("photo_id").files[0];

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
    });
</script>

<script>
    // Function to handle form submission
    function submitForm() {
        // Perform any validation or checks here if needed

        // Submit the form
        document.getElementById("formPhoto").submit();
    }

    // Attach the submitForm function to the submit button's click event
    document.getElementById("next").addEventListener("click", function() {
        window.location.href = "submitted.php";
    });

    // Function to navigate back to the previous page
    function goBack() {
        window.location.href = "spes_profile.php";
    }

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
