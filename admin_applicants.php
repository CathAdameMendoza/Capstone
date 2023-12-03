<?php
// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM applicants";
$result = $conn->query($sql);

if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Applicants' List</title>
    <link href="bootstrap.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<style>
  
.container2 {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

form h3 {
    color: #555;
    font-weight: 800;
    margin-bottom: 20px;
}
.email{
  background: white;
    display: flex;
    flex-direction: column;
    padding: 2vw 4vw;
    width: 90%;
    max-width: 600px;
    border-radius: 10px;
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

<?php include('header.php'); ?>
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
                        <span>Welcome, <br>SPES Admin</br></span>
                        <h2> </h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>SPES Admin Menu</h3>
                        <ul class="nav side-menu">
                                <li><a href="admin_homepage.php"><i class="fa fa-bars"></i> Applicants</a></li>
                                <li><a href="admin_applicants.php"><i class="fa fa-bars"></i> Applicants' List</a></li>
                                <li><a href="admin_list.php"><i class="fa fa-bars"></i> Approved Applicants</a></li>
                                <li><a href="admin_decline.php"><i class="fa fa-bars"></i> Declined Applicants</a></li>
                                <li><a href="admin_archive.php"><i class="fa fa-bars"></i> Archived Applicants</a></li>
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
              <h2> SPES Admin </h2>

              
              <?php
include("conn.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"]; // Get the search term from the form
    $filter = $_POST["filter"]; // Get the selected filter from the form

    // Create a connection to the database
    $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

    // Query to search applicants based on the selected filter
    $sql = "SELECT * FROM applicants WHERE $filter LIKE '%$search%' OR email LIKE '%$search%' OR id LIKE '%$search%' OR type_Application LIKE '%$search%' OR status LIKE '%$search%'"; 
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
} else {
    // Query to fetch all applicants when the form is not submitted
    $sql = "SELECT * FROM applicants";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error in SQL query: " . $conn->error);
    }
}
?>

<form class="search-form" method="POST" action="" style="text-align: center; margin-top: 20px; font-family: Arial, sans-serif;">

    <input class="search-input" type="text" name="search" placeholder="Search Applicant" style="padding: 10px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">

    <select name="filter" style="padding: 10px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
        <option value="first_Name">First Name</option>
        <option value="email">Email</option>
        <option value="id">ID</option>
        <option value="type_Application">Type Application</option>
        <option value="status">Status</option>
    </select>

    <button type="submit" style="padding: 10px; background-color: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Search</button>

</form>
      <!-- Box Container Rows with Table -->
      <div class="box-container row box-b"> 
      <?php if ($result->num_rows > 0) : ?>
        <table class="content-table">
        <thead>
                <tr>
                  <th>Applicant Number</th>
                  <th>Types of Application</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Remarks</th>
                  <th>Action</th>
                  <th>Applicants Details</th>
                  

                </tr>
            </thead>
            <tbody>
                <?php 
                while ($row = $result->fetch_assoc()) : ?>
                  <tr class="table-row" data-applicant-id="<?= $row['id'] ?>">
                    <td><?php  echo str_pad($row['id'], 5, '0', STR_PAD_LEFT);  ?></td>
                    <td><?= $row['type_Application'] ?></td>
                    <td><?= $row['first_Name'] .' '.$row['middle_Name'] .' '.$row['last_Name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>

                    </td>
                    <td >
                  
                      <button class="approve-button btn btn-success btn-sm" onsubmit="sendEmail(); reset(); return false;" style="background-color:#087c04; border:none;"><i class="ri-check-line"></i></button>
                    
               
                    <button href="#details3<?php echo $row['id']; ?>" data-toggle="modal" class="decline-button btn btn-danger btn-sm"style=" background-color:#e81c24;border:none;">
                    <i class="ri-close-fill"></i> </button>

                
                  
                    </td>
                    <td>
                      <a href="#details<?php echo $row['user_id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm">
                      <i class="ri-file-text-line"></i>
                      </a>
                      <a href="#details2<?php echo $row['id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm">
                      <i class="ri-file-3-line"></i>
                      </a>
                   
                   
                  

<!-- Email Modal -->
<div class="modal fade" id="details3<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #333855; color: #ffffff;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Applicants Documents</h4></center>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="container-fluid">
                    <div class="container2">
                        <form class="email" onsubmit="Decline(); reset(); return false;">
                            <h3 style="text-align: center; color: #333855; font-size: 1.5em;">Get In Touch</h3>
                            <div style="margin-bottom: 15px;">
                                <label for="name" style="font-size: 1.2em;">SPES Admin</label>
                                <input type="text" id="name" placeholder="SPES Admin" style="width: 100%; font-size: 1.2em;" disabled>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="email" style="font-size: 1.2em;">Email</label>
                                <input type="email" id="email" value="<?php echo $row['email']; ?>" style="width: 100%; font-size: 1.2em;" disabled>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="phone" style="font-size: 1.2em;">Phone Number</label>
                                <input type="text" id="phone" placeholder="Phone Number" style="width: 100%; font-size: 1.2em;" required="required"  name="phone" 
								pattern="[0-9]{11}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').substring(0, 11)"
								value="<?php echo isset($_SESSION['user_data']['phone']) ? $_SESSION['user_data']['phone'] : ''; ?>" />
                                
                                 
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label for="message" style="font-size: 1.2em;">Message</label>
                                <textarea id="message" rows="4" placeholder="How can we help you?" style="width: 100%; font-size: 1.2em;"></textarea>
                            </div>
                            <button type="submit" style="background-color: #333855; color: #ffffff; padding: 10px; border: none; cursor: pointer; font-size: 1.2em;">Send</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #e74c3c; color: #ffffff; font-size: 1.2em;"><span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Applicants Documents -->
<div class="modal fade" id="details2<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" style="max-width: 600px;"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Applicants Documents</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped">
                      <thead>
                      <?php
                            include("conn.php");
                            // Create a connection to the database
                            $conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

                            // Query to select documents for a specific user
                            $id = $row['id'];
                            $sql = "SELECT * FROM applicant_documents WHERE id = $id";
                            $query = $conn->query($sql);

                            while ($doc_row = $query->fetch_array()) {
                            ?>
                        <tr>
                          <th>
                          Application ID: <?php echo str_pad($doc_row['id'], 5, '0', STR_PAD_LEFT); ?>
                              </th>
                        </tr>
                      </thead>
                        <thead>
                            <tr>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody style="background-color:transparent;">
                            
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo $doc_row['birth_certificate']; ?>" target="_blank" style="width:200px">View Birth Certificate</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo $doc_row['photo_grades']; ?>" target="_blank"style="width:200px">View Grades</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo $doc_row['photo_itr']; ?>" target="_blank"style="width:200px">View ITR</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo $doc_row['school_id_photo']; ?>" target="_blank"style="width:200px">View School ID</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="btn btn-primary" href="<?php echo $doc_row['e_signature']; ?>" target="_blank"style="width:200px">View E-signature</a>
                                    </td>
                                </tr>
                                
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Applicants Details -->
<form>
<div class="modal fade" id="details<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Applicants Full Details</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    </h5>
                    <table class="table table-bordered table-striped">
            <tbody>
              
            <?php 
            include("conn.php");
// Create a connection to the database
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Query to select the row based on the provided 'id'
$sql="select * from applicants where id='".$row['id']."'";


$query=$conn->query($sql);
while($row=$query->fetch_array()){
					?>
			</div>
		  <div class="x_content">
</div>
			<br/> 
    
<br></br>
			<form id="demo-form" class="form-horizontal form-label-left" method="POST" action="">
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_Application">Type of Application:</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				<input type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $row['type_Application']; ?>" disabled/>
			</div>
			  </div>
<br></br>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_Name">Name:</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				<input type="text" class="form-control col-md-7 col-xs-12" value="<?= $row['first_Name'] .' '.$row['middle_Name'] .' '.$row['last_Name'] ?>" disabled/>
			</div>
			  </div>
<br></br>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth: </label>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $row['birthday']; ?>"disabled />
				</div>

				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12"  type="text" name="place_of_birth" id="Place of Birth" value="<?php echo $row['place_of_birth']; ?>" disabled/>
				</div>

				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12"  type="text" name="citizenship"  value="<?php echo $row['citizenship']; ?>" disabled/>
				</div>
			  </div>
<br></br>
			  <div class="ln_solid"></div>	
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Contact: </label>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12"  type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" disabled/>
				</div>
				<div class="col-md-5 col-sm-4 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" id="email" name="email"  value="<?php echo $row['email']; ?>"disabled/>
				</div>
			  </div>
<br></br>	  	  	
				<div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Civil Status/Sex/Spes Type: </label>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="civil_status"   value="<?php echo $row['civil_status']; ?>"disabled>
					<option value="0">Civil Status</option>
				</div>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="sex"   value="<?php echo $row['sex']; ?>"disabled>
				  		<option value=""> Sex</option>				  </select>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="spes_type"  value="<?php echo $row['spes_type']; ?>"disabled>
				  		<option value=""> Spes Type</option>				  </select>
				</div>
			  </div>
<br></br>
<br></br>
				<div class="ln_solid"></div>			  
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Status: </label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" name="parent_status"  value=" <?php echo $row['parent_status']; ?>" disabled/>
				</div>
			  </div>
<br></br>				  
				<div class="ln_solid"></div>			  
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Parent is displaced worker/s?: </label>
				<div class="col-md-4 col-sm-3 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" name="parents_displaced"  value=" <?php echo $row['parents_displaced']; ?>" disabled/>
				</div>
			  </div>
<br></br>		  
				<div class="ln_solid"></div>			  
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Present Address St./Sitio: *</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" name="no_street"  value=" <?php echo $row['no_street']; ?>" disabled/>
				</div>
			  </div>
<br></br>	
				<div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">Province/City/Barangay: </label>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="province_id"   value="<?php echo $row['province_id']; ?>"disabled>
					<option value="0">Province</option>
				</div>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="city_municipality_id"   value="<?php echo $row['city_municipality_id']; ?>"disabled>
				  		<option value=""> City</option>				  
				</div>
				<div class="col-md-3 col-sm-2 col-xs-12">
				  <input class="form-control" type="text" name="barangay_id"  value="<?php echo $row['barangay_id']; ?>"disabled>
				  		<option value=""> Barangay</option>				  
				</div>
			  </div>
<br></br>
<br></br>
				<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_Name">Father's Name:</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				<input type="text" class="form-control col-md-7 col-xs-12" value="<?= $row['father_first_name'] .' '.$row['father_middle_name'] .' '.$row['father_last_name'] ?>"disabled />
			</div>
			  </div>
<br></br>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Father's Contact No.: <span class="required">*</span></label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="father_contact_no"  value="<?php echo $row['father_contact_no']; ?>"disabled/>
				</div>
			  </div>		
<br></br>	  
				<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_Name">Mother's Name:</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				<input type="text" class="form-control col-md-7 col-xs-12" value="<?= $row['mother_first_name'] .' '.$row['mother_middle_name'] .' '.$row['mother_last_name'] ?>"disabled />
			</div>
			  </div>
<br></br>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Mother's Contact No.: <span class="required">*</span></label>
				<div class="col-md-8 col-sm-6 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="mother_contact_no"  value="<?php echo $row['mother_contact_no']; ?>"disabled/>
				</div>
			  </div>		
<br></br>	
<br></br>

			  <div class="ln_solid"></div>
			  			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">Elementary:</span></label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				<input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" id="elem_name" name="elem_name"  value="<?php echo $row['elem_name']; ?>"disabled />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control col-md-7 col-xs-12" type="text" id="elem_degree" ame="elem_degree" placeholder="Degree" disabled />
				</div>
        <div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="hs_year_level" id="hs_year_level"  value="<?php echo $row['year_grade_level']; ?>"disabled>
          <option value="0">Year Level</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course" value="<?php echo $row['elem_date_attendance']; ?>"disabled>
          <option value="0">Year End</option>
			  </div>
			  </div>	
<br></br>	
<br></br>			  				
			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">High School: </label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" id="hs_name" name="hs_name"  value="<?php echo $row['hs_name']; ?>"disabled  />
				</div>
        <div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course" value="<?php echo $row['hs_degree']; ?>"disabled>
          <option value="0">Degree</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="hs_year_level" id="hs_year_level"  value="<?php echo $row['hs_year_level']; ?>"disabled>
          <option value="0">Year Level</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course" value="<?php echo $row['hs_date_attendance']; ?>"disabled>
          <option value="0">Year End</option>
			  </div>
</div>
  <br></br>		
  <br></br>	
			  <div class="form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-6">College: </label>
				<div class="col-md-4 col-sm-2 col-xs-12">
				  <input class="date-picker form-control col-md-7 col-xs-12" type="text" id="suc_name" name="suc_name" placeholder="College Name (Leave as Blank if None)" value="<?php echo $row['suc_name']; ?>"disabled  />
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course" value="<?php echo $row['suc_course']; ?>"disabled>
          <option value="0">Degree</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_year_level" id="suc_year_level" value="<?php echo $row['suc_year_level']; ?>"disabled>
          <option value="0">Year Level</option>
				</div>
				<div class="col-md-2 col-sm-2 col-xs-12">
				  <input class="form-control" name="suc_course" id="suc_course" value="<?php echo $row['suc_date_attendance']; ?>"disabled>
          <option value="0">Year End</option>
			  </div>
			  </div>	
			  </div>	
<br></br>			
			  <div class="form-group">
			  	<label class="control-label col-md-3 col-sm-3 col-xs-12">How many times have you been a SPES beneficiary?:</label>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<input class="form-control" id='spes_times' name="spes_times" value="<?php echo $row['spes_times']; ?>"disabled>
          </td>
                      </tr>
					<br><br>
				</div>
              
            </div>	
          </form>			
              <?php
              }	
            ?>
              </table>
            </div>
          </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                </div>
            </div>
        

              
                <?php endwhile; ?>
            </tbody>
        </table>
<?php endif; ?>

</div>
            </form>
            <?php
// Perform database connection and query to retrieve the email
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = 'spes_db';

$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT email FROM applicants WHERE id=$id"; // Modify this query to match your database structure and condition
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $recipientEmail = $row['email'];
}
?>

<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script>
  function sendEmail() {
    // Use the PHP variable $recipientEmail to populate the 'To' field
    Email.send({
      Host: "smtp.elasticemail.com",
      Username: "batangascity.spes@gmail.com",
      Password: "13601B6261F0836EF26380F07D866D7D792B",
      To: '<?php echo $recipientEmail; ?>', // Populate 'To' with the fetched email
      From: "batangascity.spes@gmail.com",
      Subject: "ESPES APPLICANT UPDATE",
      Body: "We are happy to inform you that you passed the espes application"
    }).then(
      function(message) {
                // Display SweetAlert message
                Swal.fire({
                title: 'Email Sent',
                text: 'The email has been sent successfully!',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    content: 'alert-content',
                    confirmButton: 'alert-confirm-button'
                }
            });
        }, 500);
    }
</script>

<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function Decline() {
    // Use the PHP variable $recipientEmail to populate the 'To' field
    Email.send({
      Host: "smtp.elasticemail.com",
      Username: "batangascity.spes@gmail.com",
      Password: "13601B6261F0836EF26380F07D866D7D792B",
      To: '<?php echo $recipientEmail; ?>', // Populate 'To' with the fetched email
      From: "batangascity.spes@gmail.com",
      Subject: "ESPES APPLICANT UPDATE",
      Body: "Phone Number:" + document.getElementById("phone").value +
        "<br> Message:" + document.getElementById("message").value
    }).then(
      function(message) {
                // Display SweetAlert message
                Swal.fire({
                title: 'Email Sent',
                text: 'The email has been sent successfully!',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    title: 'alert-title',
                    content: 'alert-content',
                    confirmButton: 'alert-confirm-button'
                }
            });
        }, 500);
    }
</script>









        <!-- footer content -->
        <footer id="mainFooter" style="position: fixed; bottom: 0; left: 0; width: 85%">
            &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES)
        </footer>

        <!-- /footer content -->
      </div>
    </div>

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

    $(document).ready(function () {
        // View Button Click Event
        $('.view-button').click(function () {
            // Get the applicant's information and perform the "View" action
            var row = $(this).closest('tr');
            var applicantNumber = row.find('td:eq(0)').text();
            var name = row.find('td:eq(1)').text();
            var email = row.find('td:eq(2)').text();
            var status = row.find('td:eq(3)').text();

            // You can implement the "View" action here, e.g., showing a modal with applicant details.
            // Replace the following alert with your custom code.
            alert('View clicked for Applicant Number: ' + applicantNumber + '\nName: ' + name + '\nEmail: ' + email + '\nStatus: ' + status);
        });

        // Approve Button Click Event
       // $('.approve-button').click(function () {
            // Get the applicant's information and perform the "Approve" action
            var row = $(this).closest('tr');
            var applicantNumber = row.find('td:eq(0)').text();
            
            // You can implement the "Approve" action here, e.g., updating the status to "Approved."
            // Replace the following alert with your custom code.
          //  alert('Approved clicked for Applicant Number: ' + applicantNumber);
       // });

        // Decline Button Click Event
        $('.decline-button').click(function () {
            // Get the applicant's information and perform the "Decline" action
            var row = $(this).closest('tr');
            var applicantNumber = row.find('td:eq(0)').text();
            
            // You can implement the "Decline" action here, e.g., updating the status to "Declined."
            // Replace the following alert with your custom code.
            alert('Decline clicked for Applicant Number: ' + applicantNumber);
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Approve Button Click Event
        $('.approve-button').click(function () {
            var row = $(this).closest('tr');
            var applicantID = row.data('applicant-id');

            // Send an AJAX request to update the status to 'Approved'
            $.ajax({
                url: 'update_status.php', // Create a PHP script to handle the update
                method: 'POST',
                data: {
                    applicantID: applicantID,
                    newStatus: 'Approved'
                },
                success: function (response) {
                    // Check if the update was successful
                    if (response === 'success') {
                      location.reload();
                        row.find('td:eq(4)').text('Approved');
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the status.');
                }
            });
        });

        // Decline Button Click Event
  
    });
</script>

<script>
    $(document).ready(function () {
        // Decline Button Click Event
        $('.decline-button').click(function () {
            var row = $(this).closest('tr');
            var applicantID = row.data('applicant-id');

            // Send an AJAX request to update the status to 'Declined'
            $.ajax({
                url: 'update_status.php', // Create a PHP script to handle the update
                method: 'POST',
                data: {
                    applicantID: applicantID,
                    newStatus: 'Declined'
                },
                success: function (response) {
                    // Check if the update was successful
                    if (response === 'success') {
                      location.reload();
                        row.find('td:eq(4)').text('Declined');
                    } else {
                        alert('Failed to update status.');
                    }
                },
                error: function () {
                    alert('An error occurred while updating the status.');
                }
            });
        });
    });
</script>

</body>
</html>