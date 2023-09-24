<?php
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'spes_db';

// Start a session (if not already started)
session_start();

// Create a database connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Initialize variables for form data
$firstName = $middleName = $lastName = $typeApplication = $mobileNo = $sex = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $middleName = $_POST['middle_name'];
    $lastName = $_POST['last_name'];
    $typeApplication = $_POST['type_Application'];
    $mobileNo = $_POST['mobile_no'];
    $sex = $_POST['sex'];

    // Insert data into the "applicants" table
    $sql = "INSERT INTO applicants (first_Name, middle_Name, last_Name, type_Application, mobile_no, sex) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $firstName, $middleName, $lastName, $typeApplication, $mobileNo, $sex);

    if ($stmt->execute()) {
        // Data inserted successfully

        // Check if the user is logged in and retrieve their user ID from the session or another method.
        // Replace '$_SESSION['user_id']' with the appropriate method of obtaining the user's ID.
        $userID = $_SESSION['user_id']; // Change this to match your actual session variable.

        // Fetch user data based on the user ID
        $selectSql = "SELECT first_Name, middle_Name, last_Name, type_Application, mobile_no, sex FROM applicants WHERE id = ?";
        $selectStmt = $conn->prepare($selectSql);
        $selectStmt->bind_param("i", $userID);
        $selectStmt->execute();
        $selectResult = $selectStmt->get_result();

        if ($selectResult->num_rows > 0) {
            $userData = $selectResult->fetch_assoc();
            // You can use $userData for further processing or display.
        } else {
            // Handle the case where the user data is not found (e.g., display an error message).
            echo "User data not found.";
        }

        // Close the prepared statement
        $selectStmt->close();
    } else {
        // Error occurred while inserting data
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Applicant </title>
    <!-- Bootstrap -->
    <link href="bootstrap.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="daterangepicker.css" rel="stylesheet">
    <!-- Emmet -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emmet/2.3.4/emmet.cjs.js" integrity="sha512-/0TtlmFaP6kPAvDm5nsVp86JQQ1QlfFXaLV9svYbZNtGUSSvi7c3FFSRrs63B9j6iM+gBffFA3AcL4V3mUxycw==" crossorigin="anonymous"></script>
    <!-- Custom Theme Style -->
    <link href="custom.css" rel="stylesheet">
	  <!-- <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="29efea84-679c-4042-bdb8-a3ccc09e5088";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script> -->
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Apply "Century Gothic" font to specific elements */
        body, h2, .info-span {
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
                        <span>Welcome, <br> Applicant</br></span>
                        <h2> </h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="c">
  				<div class="menu_section">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                <h3>SPES Applicant Menu</h3>
	            <ul class="nav side-menu">
	            <li><a id="menu_toggle" href="http://localhost/Capstone/spes_profile.php" ><i class="fa fa-bars"></i> My Profile</a>
                <li><a id="menu_toggle" href="http://localhost/Capstone/pre_emp_doc.php"><i class="fa fa-bars"></i> Required Docs. </a>
                <li><a id="menu_toggle" href="http://localhost/Capstone/submitted.php"><i class="fa fa-bars"></i> Submitted. </a>
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
        
        <div id="mainContent" class="right_col " role="main">
          <h2 style="font-size: 20px;" >SPES Applicant</h2>
            <div class="separator my-10"></div>

            <div class="box-container">
</div>
<div class="content fs-6 d-flex flex-column-fluid" id="kt_content">
  <div class="container-xxl">
    <div class="card mx-auto">
      <form class="form d-flex flex-right">
        <div class="card-body mw-800px py-20 d-flex flex-column align-items-center justify-content-center ">
          <div class="row">
            <div class="col-lg-9 col-xl-6">
              <h5 class="fw-bold mb-6" style="font-size: 18px;">Overview</h5>
              <br>
            </div>
          </div>

<div class="row align-items-center">
    <label class="col-xl-4 col-lg-6 col-form-label fw-bold text-right text-lg-end">Name:</label>
    <div class="col-lg-2 col-xl-3 d-flex align-items-right fw-bold">
        <span id="first_Name" class="info-span"><?php echo isset($userData['first_name']) ? $userData['first_name'] : '00'; ?></span>
        <span id="middle_Name" class="info-span"><?php echo isset($userData['middle_name']) ? $userData['middle_name'] : '00'; ?></span>
        <span id="last_Name" class="info-span"><?php echo isset($userData['last_name']) ? $userData['last_name'] : '00'; ?></span>
    </div>
</div>

<div class="row align-items-center">
    <label class="col-xl-6 col-lg-6 col-form-label fw-bold text-right text-lg-end">Type of Application:</label>
    <div class="col-lg-2 col-xl-3 d-flex align-items-center fw-bold">
        <span id="type_Application" class="info-span"><?php echo isset($userData['type_Application']) ? $userData['type_Application'] : '00'; ?></span>
    </div>
</div>

<div class="row align-items-center">
    <label class="col-xl-6 col-lg-6 col-form-label fw-bold text-right text-lg-end">Contact:</label>
    <div class="col-lg-2 col-xl-3 d-flex align-items-start fw-bold">
        <span id="mobile_no" class="info-span"><?php echo isset($userData['mobile_no']) ? $userData['mobile_no'] : '00'; ?></span>
    </div>
</div>

<div class="row align-items-center">
    <label class="col-xl-6 col-lg-6 col-form-label fw-bold text-right text-lg-end">Sex:</label>
    <div class="col-lg-2 col-xl-3 d-flex align-items-center fw-bold">
        <span id="sex" class="info-span"><?php echo isset($userData['sex']) ? $userData['sex'] : '00'; ?></span>
    </div>
</div>

<div class="row align-items-center">
    <label class="col-xl-6 col-lg-6 col-form-label fw-bold text-right text-lg-end">Status:</label>
    <div class="col-lg-2 col-xl-3 d-flex align-items-center fw-bold">
        <span class="badge" style="font-size: 15px; background-color: #20d489; color: white;">Submitted</span>
    </div>
</div>
<br><br>
<div class="separator my-10"></div>
<br>



<div class="text-center mb-20">
<h1 class="fs-2tx fw-bolder mb-8">Your application has been
<span class="d-inline-block position-relative ms-2">
<span class="d-inline-block mb-2">submitted!</span>
</span>
</h1>
<div class="fw-bold fs-2 text-gray-500 mb-10" style="font-size: 18px;">We will reach out to you <span class="fw-bolder text-gray-900">via email (<span id="email"> </span>)</span> as soon as we have processed your application. Thank you!
<br><br><br><br><br><br><br><br><br>
</div>
</div>
</div>

</form></div>
</div>
</div>

        <!-- footer content -->
        <footer id="mainFooter">
          <div class="pull-right">
             &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES)
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
   
    <script>
      var myVar;

        function myFunction() {
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("mainContent").style.display = "block";
        }
    </script> 

<!-- Custom Theme Scripts -->
<script src="custom.js"></script>
    
    <script>
  $(document).ready(function () {
    // Toggle sidebar
    $('#menu_toggle').click(function () {
      if ($('body').hasClass('nav-md')) {
        $('body').removeClass('nav-md').addClass('nav-sm');
      } else {
        $('body').removeClass('nav-sm').addClass('nav-md');
      }
    });
  });
</script>
	
  </body>
</html>