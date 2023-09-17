<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> eSPES | Approved List </title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    


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
		<span>Welcome, <br>SPES Admin</br></span>
		<h2> </h2>
	  </div>
	</div> 
             <!-- /menu profile quick info -->
             <br />
            <!-- sidebar menu -->
				 <div id="sidebar-menu" class="c">
  				 <div class="menu_section">
           <a id="menu_toggle"><i class="fa fa-bars"></i></a>

  <h3>SPES Admin Menu</h3>
	<ul class="nav side-menu">

	  <li><a id="menu_toggle" href="http://localhost/Capstone/admin_homepage.php" ><i class="fa fa-bars"></i> Applicants</a>
    <li><a id="menu_toggle" href="http://localhost/Capstone/admin_applicants.php"><i class="fa fa-bars"></i> Applicants' List </a>	
    <li><a id="menu_toggle" href="http://localhost/Capstone/admin_list.php"><i class="fa fa-bars"></i> Approved Applicants</a>	
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
			  <h2> SPES Admin </h2>
<br />
<br />

<!-- Box Container Rows with Table -->
<div class="box-container row box-b">
    <table>
        <tr>
            <th>Applicant Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <tr>
    <td>1</td>
    <td>John Doe</td>
    <td>john@example.com</td>
    <td>Approved</td>
    <td>
        <button class="view-button">View</button>
    </td>
    </tr>
    <tr>
      <td>2</td>
      <td>Michelle Dy</td>
      <td>mich@example.com</td>
      <td>Approved</td>
      <td>
        <button class="view-button">View</button>
    </td>
    </tr>
    </table>
</div>



        <!-- footer content -->
        <footer id="mainFooter">
          <div class="pull-right">
             &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES) 
          <div class="clearfix"></div>
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
  
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
      });
        </script>

  </body>
</html>