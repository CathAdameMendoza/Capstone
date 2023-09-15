<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> eSPES | Pre-Employment Documents </title>
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
                 <li><a href="http://localhost/Capstone/landing.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                 </ul>
               </nav>
               </div> 
                     </div>
        <!-- /top navigation -->

        <div id="loader"></div>

        <!-- page content -->
        <div id="mainContent" class="right_col" role="main">
			
<!-- page content -->
  <div class="">
	<div class="page-title">
		<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top: 50px";>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<b><b>The My Profile and Required Docs. section should be both 100%.</b></b>
		</div>
	  <div class="title_left">
		<h3>Pre-Employment Documents <br /><small>Birth Certifcate, Grades/Certificate of OSY, ITR/Certificate of Indigency</small></h3>
	  </div>
	</div>
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

			  
			  < <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
				<div class="col-md-6 col-sm-6 col-xs-12">
				  <input type="hidden" name="type" value="bc" />
				  <button type="submit" class="btn btn-primary btn-sm" id="submit">Upload File/s</button>
				</div>
			  </div>
  			  <div class="ln_solid"></div>	
  			</form>
  			<form id="form" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="year">For the Year:<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				 <select class="form-control" name="year" id="year" required="required">
					<option value="">Select Year</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
					<option value="2025">2025</option>
					<option value="2026">2026</option>
					<option value="2027">2027</option>
				  </select>
				</div>
			  </div>			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="grades">Grades/Cert. OSY:<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <input type="file" name="grades_cert" id="grades_cert" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.pdf" />
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itr">ITR/Cert. Indigency:<span class="required">*</span></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
				  <input type="file" name="itr_cert_indigency" id="itr_cert_indigency" required="required" style="margin-top: 7px;" accept=".jpg,.jpeg,.pdf" />
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="itr"></label>
				<div class="col-md-3 col-sm-6 col-xs-12">
        			<button type="submit" class="btn btn-primary btn-sm" id="submit">Upload Files</button>
        			<input type="hidden" name="type" value="others" />
				</div>
			  </div>	
			</form>
			<div class="ln_solid"></div>	
			<h4>Additional Pre-Employment Documents</h4>
			<table class="table table-hover">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Year</th>
					  <th>Grades/Cert. OSY</th>
					  <th>ITR/Cert. Indigency:</th>
					  <th>Status</th>		  
					  <th>Action</th>		  		  
					</tr>
				  </thead>
				  <tbody>
				  				  </tbody>
				</table>			
		  </div>
		</div>
	  </div>
	</div>
  </div>

  <div id="uploadimageModal" class="modal" role="dialog">
	<div class="modal-dialog modal-lg">
  		<div class="modal-content">
        	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload & Crop Image</h4>
			</div>
        	<div class="modal-body">
          		<div class="row">
       				<div class="text-center">
					    <h2>Center you face on the image.</h2>
        				<div id="image_demo" class="center-image col-md-6" style="width:350px; margin-top:30px; display:inline-block; margin-left:50px; margin-right:100px;"></div>
       					</div>
						<div id="" class="center-image col-md-6" style="width:250px; margin-top:30px; display:inline-block; margin-left:70px; ">
						    <h2>Sample:</h2>
							<img style="padding: 5px; border: solid 1px" src="https://spes.dole11portal.org//images/img2.png" >
       					</div>
    				</div>
        		</div>
        		<div class="modal-footer">
		 			<button type="submit" class="btn btn-success crop_image">Crop & Upload Image</button>
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
     		</div>
    	</div>
	</div>
   </div>

   <div id="uploadBirthCertModal" class="modal" role="dialog">
	<div class="modal-dialog">
  		<div class="modal-content">
        	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload File</h4>
			</div>
        	<div class="modal-body">
          		<div class="row">
       				<div class="col-md-12 text-center">
        				<!-- <div id="birth_demo" class="center-image" style="width:350px; margin-top:30px"></div> -->
						<h2>Please confirm upload of Birth Certificate/Gov. issued ID.</h2>
       					<!-- </div> -->
    				</div>
        		</div>
        		<div class="modal-footer">
					<input type="hidden" name="type" value="bc" />
		 			<button type="submit" form="formPhoto"  class="btn btn-success">Confirm</button>
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
     		</div>
    	</div>
	</div>
   </div>

   <div id="uploadEsigModal" class="modal" role="dialog">  
	<div class="modal-dialog modal-lg">
  		<div class="modal-content">
        	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload & Crop Image</h4>
			</div>
     		</div>
    	</div>
	</div>
   </div>
<!-- /page content -->

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
	        </div>
        <!-- /page content -->

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