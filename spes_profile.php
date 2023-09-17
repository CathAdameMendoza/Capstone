<?php
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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Initialize variables to store form data
    $mobile = isset($_POST['mobile_no']) ? $_POST['mobile_no'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $last_Name = isset($_POST['last_Name']) ? $_POST['last_Name'] : '';
    $first_Name = isset($_POST['first_Name']) ? $_POST['first_Name'] : '';
    $middle_Name = isset($_POST['middle_Name']) ? $_POST['middle_Name'] : '';
    $sex = isset($_POST['sex']) ? $_POST['sex'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    // Check if the required fields are empty
    if (empty($mobile) || empty($email) || empty($password) || empty($last_Name) || empty($first_Name) || empty($middle_Name) || empty($sex) || empty($username)) {
        echo '<script>alert("Error: Please fill out all required fields.");</script>';
    } else {
        // Function to generate a 7-digit unique ID
        function generateUniqueId() {
            $length = 7;
            $characters = '0123456789';
            $uniqueId = '';

            for ($i = 0; $i < $length; $i++) {
                $uniqueId .= $characters[rand(0, strlen($characters) - 1)];
            }

            return $uniqueId;
        }

        // Function to check if a unique ID exists in the database
        function isUniqueIdExists($conn, $uniqueId) {
            $sql = "SELECT unique_id FROM users WHERE unique_id = '$uniqueId'";
            $result = $conn->query($sql);

            return $result->num_rows > 0;
        }

        // Check if the email already exists
        $checkEmailQuery = "SELECT user_id FROM users WHERE email = '$email'";
        $emailResult = $conn->query($checkEmailQuery);

        if ($emailResult->num_rows > 0) {
            echo '<script>alert("Error: Email already exists.");</script>';
        } else {
            // Prepare an SQL statement to insert user data into the database
            $sql = "INSERT INTO users (lname, gname, mname, email, gender, contact_number, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $last_Name, $first_Name, $middle_Name, $email, $sex, $mobile, $password);

            if ($stmt->execute()) {
                echo '<script>alert("User registered successfully");</script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
		}
    }
}

// Close the database connection
$conn->close();
?>

<?php
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

// Initialize progress
$progress = 0;

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing form handling code here
    
    // Update progress based on the submitted data
    if (!empty($mobile) && !empty($email) && !empty($password) && !empty($last_Name) && !empty($first_Name) && !empty($middle_Name) && !empty($sex) && !empty($username)) {
        // You can increase the progress by a certain amount here
        $progress += 10;
    }
    
    // Calculate the progress percentage
    $progress = min(100, $progress);
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
    <title> eSPES | Profile </title>
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
    <!-- Croppie -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.5.1/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />
    <!-- Custom Theme Style -->
    <link href="custom.css" rel="stylesheet">
	  <!-- <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="29efea84-679c-4042-bdb8-a3ccc09e5088";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script> -->
    <!-- jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	<body class="nav-md" >
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
		<h2> </h2>
	  </div>
	</div> 
             <!-- /menu profile quick info -->
			 <br />
            <!-- sidebar menu -->
				 <div id="sidebar-menu" class="c">
  <div class="menu_section">
	<h3>SPES Beneficiary</h3>
	<ul class="nav side-menu">
	  <li><a><i class="fa fa-home"></i> Menu <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
    <li><a href="http://localhost/Capstone/homepage.php">Dashboard</a></li>		
		  <li><a href="http://localhost/Capstone/spes_profile.php">My Profile <span class="badge bg-red pull-right">0%</span></a></li>
		  <li><a href="http://localhost/Capstone/pre_emp_doc.php">Required Docs. <span class="badge bg-red pull-right">0%</span></a></li>
      <li><a href="http://localhost/Capstone/submit_application.php">Submit Application</a></li>
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
        <div id="mainContent" class="right_col" role="main">
			
<div class="">
	<div class="page-title">
		<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top: 50px";>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<b>The My Profile and Required Docs. section should be both 100%.</b>		</div>
	  <div class="title_left">
		<h3>SPES Application Form</h3>
	  </div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Profile Details <small>Please fill out completely</small></h2>
			<ul class="nav navbar-right panel_toolbox">
			  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			  </li>
			  <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#">Settings 1</a>
				  </li>
				  <li><a href="#">Settings 2</a>
				  </li>
				</ul>
			  </li>
			  <li><a class="close-link"><i class="fa fa-close"></i></a>
			  </li>
			</ul>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content">
		  		
			<br />
			<form id="demo-form2" class="form-horizontal form-label-left" method="POST">
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_Name">First Name:<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" name="first_Name" id="first_Name" required="required" class="form-control col-md-7 col-xs-12" value="" />
				</div>
			  </div>
			  <div class="form-group">
				<label for="middle_Name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name:</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input id="middle_Name" class="form-control col-md-7 col-xs-12" type="text" required="required" name="middle_Name" value="" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_Name">Last Name:<span class="required">*</span></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="text" id="last_Name" name="last_Name" required="required" class="form-control col-md-7 col-xs-12" required="required" value="" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth: <span class="required">*</span></label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="birthday" id="birthday" placeholder="Date of Birth" value="" data-toggle="tooltip" data-placement="left" title="format: Month/Day/Year e.g. 02/21/2000" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="place_of_birth" id="Place of Birth" placeholder="Place of Birth" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="citizenship" placeholder="Citizenship" value="" />
				</div>
			  </div>
			  			  <div class="ln_solid"></div>	
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact: <span class="required">*</span></label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="mobile_no" placeholder="Mobile No." value="" />
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" required="required" id="email" name="email" placeholder="Email" value="" onblur="validate();"/>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-12">				
					<p id="result"></p>
				</div>
			  </div>
			  <div class="ln_solid"></div>
			  		  	  			  			  			  		  			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Civil Status: *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="gender" class="btn-group" data-toggle="buttons">
					<div class="radio">
						<label><input type="radio" class="flat" name="civil_status" value="1" required="required" /> Single </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="civil_status" value="2" /> Married </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="civil_status" value="3" /> Widow/er </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="civil_status" value="4" /> Separated </label>
					  </div>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Sex: *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="sex" class="btn-group" data-toggle="buttons">
					<div class="radio">
						<label><input type="radio" class="flat" name="sex" class="sex" value="sex" required="required"  /> Male </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="sex" class="sex" value="Female" /> Female </label>
					  </div>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">SPES Type: *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="gender" class="btn-group" data-toggle="buttons">
					<div class="radio">
						<label><input type="radio" class="flat" name="spes_type" value="1" required="required"  /> Student </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="spes_type" value="2" /> ALS Student </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="spes_type" value="3" /> Out of School Youth (OSY) </label>
					  </div>
				  </div>
				</div>
			  </div>
			 
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Status: *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="gender" class="btn-group" data-toggle="buttons">
					<div class="radio">
						<label><input type="radio" class="flat" name="parent_status" value="1" required="required"  /> Living Together </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="parent_status" value="2" /> Solo Parent </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="parent_status" value="3" /> Separated </label>
					  </div>
				  </div>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Parent is displaced worker/s?: *</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <div id="gender" class="btn-group" data-toggle="buttons">
					  <div class="radio">
						<label><input type="radio" class="flat" name="parents_displaced" value="0" /> No </label>
					  </div>				  
					  <div class="radio">
						<label><input type="radio" class="flat" name="parents_displaced" value="1" /> Yes, Local </label>
					  </div>
					  <div class="radio">
						<label><input type="radio" class="flat" name="parents_displaced" value="2" /> Yes, Abroad/OFW </label>
					  </div>
				  </div>
				</div>
			  </div>
			  <div class="ln_solid"></div>			  
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Present Address St./Sitio: *</label>
				<div class="col-md-4 col-sm-3 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" name="no_street" placeholder="House No., Street/Sitio" value="" />
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Province/City/Municipality/Barangay: *</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="province_id" id="province_id" required="required">
					<option value="0">Province</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="city_municipality_id" id="city_municipality_id" required="required">
				  		<option value=""> City/Municipality</option>				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="barangay_id" id="barangay_id" required="required">
				  		<option value=""> Barangay</option>				  </select>
				</div>
			  </div>
			  
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Permanent Address St./Sitio: *</label>
				<div class="col-md-4 col-sm-3 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" name="no_street2" placeholder="House No., Street/Sitio" value="" />
				</div>
			  </div>
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Province/City/Municipality/Barangay: *</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="province_id2" id="province_id2" required="required" >
					<option value=" "> Province</option>                                  
				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="city_municipality_id2" id="city_municipality_id2" required="required">
				  		<option value=""> City/Municipality</option>				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="barangay_id2" id="barangay_id2" required="required">
				  		<option value=""> Barangay</option>				  </select>
				</div>
			  </div>	
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Father's Name: <span class="required">*</span></label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="father_first_name" placeholder="First Name" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="father_middle_name" placeholder="Middle Name" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="father_last_name" placeholder="Last Name" value="" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Father's Contact No.: <span class="required">*</span></label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="father_contact_no" placeholder="Mobile No." value=""/>
				</div>
			  </div>				  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Mother's Name: <span class="required">*</span></label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="mother_first_name" placeholder="First Name" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="mother_middle_name" placeholder="Middle Name" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="mother_last_name" placeholder="Last Name" value="" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Mother's Contact No.: *</label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" type="text" name="mother_contact_no" placeholder="Mobile No." value="" />
				</div>
			  </div>			  
			  <div class="ln_solid"></div>
			  			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">Elementary:<span class="required"> *</span></label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				<input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" id="elem_name" name="elem_name" placeholder="Elementary School Name" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" id="elem_degree" ame="elem_degree" placeholder="Degree" disabled />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <select class="form-control" name="year_grade_level" id="year_grade_level" required="required">
					<option value="">Select Grade</option>
					<option value="1">Grade 1</option>
					<option value="2">Grade 2</option>
					<option value="3">Grade 3</option>
					<option value="4">Grade 4</option>
					<option value="5">Grade 5</option>
					<option value="6">Grade 6/Graduating</option>
					<option value="7">Graduate</option>					
				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" id="elem_date_attendance" name="elem_date_attendance" placeholder="Year Started - Year Ended" data-toggle="tooltip" data-placement="left" title="Date Attendance format: Year - Year e.g. 2014 - 2017" value="" />
				</div>
			  </div>	
				<script>
					$('#year_grade_level').val();
				</script>
			  				
			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">High School: *</label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" id="hs_name" name="hs_name" placeholder="High School Name" value=""  />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" id="hs_degree" name="hs_degree" placeholder="Degree, 'n/a' if None"  required="required" value="" />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <select class="form-control" name="hs_year_level" id="hs_year_level" required="required">
				  	<option value="">Select Year</option>
					<option value="1">Grade 7/First Year</option>
					<option value="2">Grade 8/Second Year</option>
					<option value="3">Grade 9/Third Year</option>
					<option value="4">Grade 10/Fourth Year</option>
					<option value="5">Grade 11/Senior High 1</option>
					<option value="6">Grade 12/Senior High 2/Graduating</option>
					<option value="8">Graduate</option>					
				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" required="required" type="text" id="hs_date_attendance" name="hs_date_attendance" placeholder="SY" data-toggle="tooltip" data-placement="left" title="Date Attendance format: Year - Year e.g. 2014 - 2017" value="" />
				</div>
			  </div>
			  	<script>
					$('#hs_year_level').val();
				</script>
					
			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">College: </label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" type="text" id="suc_name" name="suc_name" placeholder="College Name (Leave as Blank if None)" value=""  />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course">
				  		
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <select class="form-control" name="suc_year_level" id="suc_year_level">
					<option value="">Select Year</option>
					<option value="1">First Year</option>
					<option value="2">Second Year</option>
					<option value="3">Third Year</option>
					<option value="4">Fourth Year</option>					
					<option value="5">Fourth Year/Graduating</option>
					<option value="6">Fifth Year/Graduating</option>
					<option value="7">Graduate</option>					
				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" id="suc_date_attendance" name="suc_date_attendance" placeholder="SY" data-toggle="tooltip" data-placement="left" title="Date Attendance format: Year - Year e.g.2014 - 2017" value="" />
				</div>
			  </div>	
			  
			  
			  	<script>
					$('#suc_year_level').val();
					$('#suc_course').val();
				</script>

					
			  </div>			
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">How many times have you been a SPES beneficiary?:</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<select class="form-control" required="required" id='spes_times' name="spes_times">
						<option name="spes_times" value="0" selected>0 (First Time)</option>
													<option name="spes_times" value="1">1</option>
													<option name="spes_times" value="2">2</option>
													<option name="spes_times" value="3">3</option>
													<option name="spes_times" value="4">4</option>
											</select>
					<input id="spes_baby" name="spes_baby" type="hidden">
				</div>
					
			  </div>				
			  <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button class="btn btn-primary" type="button" onclick="cancelEditProfile()">Cancel</button>
				  <button class="btn btn-warning" type="reset">Reset</button>
				  <button type="submit" class="btn btn-success" id="submit">Submit</button>				</div>
			  </div>
			  <div class="progress">
       			 <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progress; ?>%</div>
    			</div>
			</form>
		  </div>
		</div>
	  </div>
	</div>
	
	
<script>
	
	function cancelEditProfile() {
		window.location.href = '../';
	}

	function validateEmail(email) {
	  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}

	function validate() {
	  var $result = $("#result");
	  var email = $("#email").val();
	  $result.text("");

	  if (validateEmail(email)) {
		$result.text(email + " is a valid Email.");
		$result.css("color", "green");
	  } else {
	  	$("#email").val('');
		$result.text(email + " is not a valid Email.");
		$result.css("color", "red");
	  }
	  return false;
	}

	//$("#submit").bind("click", validate);
	
	$('input:radio[name="gender"][value=""]').prop('checked', true);
	$('input:radio[name="civil_status"][value=""]').prop('checked', true);
	$('input:radio[name="spes_type"][value=""]').prop('checked', true);
	$('input:radio[name="parent_status"][value=""]').prop('checked', true);
	
	</script>
        </div>\


        <!-- footer content -->
        <footer id="mainFooter">
          <div class="pull-right">
             &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES) 
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- NProgress -->
	 <script src="nprogress.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="bootstrap-progressbar.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="daterangepicker.js"></script>>
    <!-- starrr -->
    <script src="starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="custom.js"></script>
<!-- 
    <script>
      var myVar;

        function myFunction() {
            myVar = setTimeout(showPage, 3000);
        }

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("mainContent").style.display = "block";
        }
    </script> -->
	<script>
$(document).ready(function() {
  // Add a click event handler to the parent menu items with a dropdown
  $("#sidebar-menu .nav.side-menu > li > a").click(function(e) {
    e.preventDefault(); // Prevent the default link behavior
    $(this).parent().toggleClass("active"); // Toggle the "active" class on the parent li
    $(this).find(".fa-chevron-down").toggleClass("fa-chevron-up"); // Toggle the chevron icon
    $(this).next("ul.nav.child_menu").slideToggle(); // Toggle the child menu
  });
});
</script>

	
  </body>
</html>