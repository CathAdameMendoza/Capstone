<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Submit SPES Application </title>
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
	  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
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

        <!-- <div id="loader"></div> -->

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
		<h3>Submit SPES Application <br /></h3>
	  </div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>Application Progress</h2>
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
			  				<div hidden id="alertMessage" class="alert alert-success alert-dismissible fade in"><i class="glyphicon glyphicon-question-sign"></i> </div>		  
			<form id="formPhoto" data-parsley-validate class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
			 

                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12"><h2>Profile Details: </h2></label>
                    <div class="progress col-md-7 col-sm-7 col-xs-12">
                        <div class="progress-bar progress-bar-striped active progress-bar-warning" 
                              role="progressbar" 
                              aria-valuenow="3" 
                              aria-valuemin="0" 
                              aria-valuemax="100" 
                              style="width: 3%";>
                                  0%
                                </div>                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-sm-3 col-xs-12"><h2>Required Documents: </h2></label>
                    <div class="progress col-md-7 col-sm-7 col-xs-12">
                        <div class="progress-bar progress-bar-striped active progress-bar-danger" 
                              role="progressbar" 
                              aria-valuenow="3" 
                              aria-valuemin="0" 
                              aria-valuemax="100" 
                              style="width: 3%";>
                              0%
                            </div>                    </div>
                </div>
              <div class="ln_solid"></div>	
			  <div class="form-group">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <button disabled type="submit" class="btn btn-primary btn-sm" id="submit" title="Profile Details and Required Docs. should be both 100%">Submit Application</button>                    </div>
                </div>
               </div>
  			  
  			</form>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>

		  </div>
		</div>
	  </div>
	</div>
  </div>

  
<!-- /page content -->

<script>
	
	$('#submit').click(function(event){
        alert("Application has been submitted and will be reviewed. ");
	});

	
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