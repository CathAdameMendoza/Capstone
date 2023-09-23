<?php
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'spes_db';

// Create a database connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "year" field is set
    if (isset($_POST["year"])) {
        $year = $_POST["year"];
    } else {
        // Handle the case where "year" is not set
        echo "Year is not set.";
        exit;
    }

    // Define an array to store file upload results
    $uploadResults = [];

    // Define the target directory for file uploads
    $targetDirectory = "uploads/";

    // Loop through the uploaded files
    foreach ($_FILES as $fieldName => $file) {
        $targetFile = $targetDirectory . uniqid() . "_" . basename($file["name"]);

        // Check if the file upload was successful
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Upload the file to the server
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $uploadResults[$fieldName] = "File uploaded successfully.";
            } else {
                $uploadResults[$fieldName] = "File upload failed.";
            }
        } else {
            $uploadResults[$fieldName] = "File upload failed with error code: " . $file['error'];
        }
    }

    // Now, you can handle the database insertion as per your requirements
    // Example code to insert data into the database
    $sql = "INSERT INTO your_table_name (year, file1, file2, ...) VALUES (?, ?, ?, ...)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $year, $uploadResults['photo'], $uploadResults['bc_file']);
    
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data saved in the database.";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Applicant Home Page </title>
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
  </head>

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
           <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            <h3>SPES Applicant Menu</h3>
	        <ul class="nav side-menu">
	        <li><a id="menu_toggle" href="http://localhost/Capstone/spes_profile.php" ><i class="fa fa-bars"></i> My Profile</a>
            <li><a id="menu_toggle" href="http://localhost/Capstone/pre_emp_doc.php"><i class="fa fa-bars"></i> Required Docs. </a>	
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
                 <li><a href="http://localhost/Capstone/index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                 </ul>
               </nav>
               </div> 
                     </div>
        <!-- /top navigation -->

        <div id="loader"></div>

        <!-- page content -->
        <div id="mainContent" class="right_col" role="main">
			
<!-- page content -->
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2><small>Please upload required files</small></h2>
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
			  <div class="alert alert-warning alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<b>Warning!</b> You cannot make any changes to these documents once your application is approved.
			  </div>
			  				<div hidden id="alertMessage" class="alert alert-success alert-dismissible fade in"><i class="glyphicon glyphicon-question-sign"></i> </div>		  
			<form id="formPhoto" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">School ID (Scanned Image):<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				 					 	<input type="file" name="photo" id="photo" style="margin-top: 7px; " accept=".jpg,.jpeg,.png" />
				</div>
				<div id="uploaded_image" class="col-md-3 col-sm-6 col-xs-12">
				 					</div>
			  </div>
			  <div class="form-group" style="margin-top: 30px;">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="bc_file">Birth Certificate/Gov. issued ID (PDF File / Scanned Image):<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				  				  <input type="file" name="bc_file" id="bc_file" style="margin-top: 7px; " accept=".jpg,.jpeg,.pdf" />
				  <input type="hidden" name="type" value="bc" />
				</div>				
				<div class="col-md-3 col-sm-6 col-xs-12">
				  				</div>
			  </div>

			  <div class="form-group" style="margin-top: 30px;">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="esig_file"> 3 E-Signature (Scanned Image):<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				  				  <input type="file" name="esig_file" id="esig_file" style="margin-top: 7px; " accept=".jpg,.jpeg,.png,.gif" />
				</div>				
				<div id="uploaded_esig" class="col-md-3 col-sm-6 col-xs-12">
				  				</div>
			  </div>

    <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grades_cert">Grades/Cert. OSY:<span class="required">*</span></label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <form id="formGradesCert" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
            <input type="file" name="grades_cert" id="grades_cert" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.pdf" />
        </form>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="itr_cert_indigency">ITR/Cert. Indigency:<span class="required">*</span></label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <form id="formITRCert" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
            <input type="file" name="itr_cert_indigency" id="itr_cert_indigency" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.pdf" />
            <input type="hidden" name="type" value="others" />
        </form>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <button type="submit" form="formITRCert" class="btn btn-primary btn-sm" id="submitITRCert">Upload Files</button>
    </div>
</div>

<div id="uploadBirthCertModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload File</h4>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="additional_document">Additional Document:<span class="required">*</span></label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <form id="formAdditionalDocument" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
					<input type="file" name="additional_document" id="additional_document" required="required" />
                        <input type="hidden" name="type" value="others" />
                    </form>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <button type="submit" form="formAdditionalDocument" class="btn btn-primary btn-sm" id="submitAdditionalDocument">Upload Files</button>
                </div>
            </div>
        </div>
    </div>
</div>

	<br>
   <div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<button class="btn btn-primary" type="button" onclick="cancelEditProfile()">Cancel</button>
					<button class="btn btn-warning" type="reset">Reset</button>
          <button type="submit" name="submit" class="btn btn-success" id="submit">Submit</button>
          
				</div>
			</div>
<script>


	function remove_doc(id) {
		
		if(confirm('Are you sure to delete this records?')) {
			$('#remove_' + id).html('loading..');
			$('#remove_' + id).attr('disabled', 'disabled');
			$.get('remove_pre_emp_doc/' + id, function(data) {
				location.reload();
			});
		}
	}
	
</script>

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