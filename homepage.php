<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eSPES | Home </title>
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
			
<h2> Good day, Applicant </h2>
<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-top: 10px";>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <b><b>The My Profile and Required Docs. section should be both 100%.</b></b>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
   
   <!-- <script>
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