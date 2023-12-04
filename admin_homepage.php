<?php 
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "spes_db";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> eSPES | Admin Homepage </title>
    <link href="bootstrap.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
    <style>
        .wrapper{
        width: 100%;

        }
        .dashboard-wide{
        box-shadow: 0 0 30px rgba(0, 0, 0, .5);
        background: #ffffff;
        border-radius: 8px;
        padding: 20px ;
        margin-bottom: 20px;
        width: 90%;
        height:50vh;
        display: inline-block;
        vertical-align: top;
        margin-left: 30px;
        transition: transform 0.3s ease;
        }
        .dashboard-box {
        text-align: center;
        align-items: center;
        align-content: center;
        align-self: center;
        box-shadow: 0 0 30px rgba(0, 0, 0, .1);
        background: #ffffff;
        border-radius: 8px;
        padding: 20px ;
        margin-bottom: 20px;
        width: 220px;
        height:140px;
        display: inline-block;
        vertical-align: top;
        margin-left: 30px;
        transition: transform 0.3s ease;
        }

        .dashboard-box:hover{
        transform: translateY(-2px);
        background-color: rgb(255, 253, 253);
        }


        .box-title {
        font-size: 15px;
        margin-bottom: 10px;
        color: #033349;
        }

        .box-content {
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #303c54;
        align-content: center;
        justify-self: center;
        }

        .box-footer {
        
        margin-top: 10px;
        font-size: 10px;
        color: #000000;
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
            <h2>SPES Admin</h2>
            <div class="wrapper">
                <center><h4>Monitoring Dashboard</h4></center>

                <div class="dashboard-box">
                <h3 class="box-title"> Total Applicants</h3>
                <?php    
                $totaladminQuery = "SELECT COUNT(*) AS total_admin, MAX(date_change) AS last_updated FROM applicants ";
                $totaladminResult = $conn->query($totaladminQuery);
                $totaladminRow = $totaladminResult->fetch_assoc();
                $totaladmin = $totaladminRow['total_admin'];
                $lastUpdated = $totaladminRow['last_updated'];

                echo '<p class="box-content">' . number_format($totaladmin, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';
                ?>
                </div>

                <div class="dashboard-box">
                <h3 class="box-title">New Applicants</h3>
                <?php    
                $totalborrowerQuery = "SELECT COUNT(*) AS total_borrower, MAX(date_change) AS last_updated FROM applicants WHERE type_Application = 'New Applicants'";
                $totalborrowerResult = $conn->query($totalborrowerQuery);
                $totalborrowerRow = $totalborrowerResult->fetch_assoc();
                $totalborrower = $totalborrowerRow['total_borrower'];
                $lastUpdated = $totalborrowerRow['last_updated'];

                echo '<p class="box-content">' . number_format($totalborrower, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';
                ?>
                </div>

                <div class="dashboard-box">
                <h3 class="box-title">Renewal Applicants</h3>
                <?php    
                $totalitemQuery = "SELECT COUNT(*) AS total_item, MAX(date_change) AS last_updated FROM applicants WHERE type_Application = 'Renewal'";
                $totalitemResult = $conn->query($totalitemQuery);
                $totalitemRow = $totalitemResult->fetch_assoc();
                $totalitem = $totalitemRow['total_item'];
                $lastUpdated = $totalitemRow['last_updated'];

                echo '<p class="box-content">' . number_format($totalitem, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';
                ?>
                </div>

                <div class="dashboard-box">
                <h3 class="box-title"> Approved Applicant</h3>
                <?php   
                $totaltoolsQuery = "SELECT COUNT(*) AS total_tools, MAX(date_change) AS last_updated FROM applicants WHERE status = 'Approved'";
                $totaltoolsResult = $conn->query($totaltoolsQuery);
                $totaltoolsRow = $totaltoolsResult->fetch_assoc();
                $totaltools = $totaltoolsRow['total_tools'];
                $lastUpdated = $totaltoolsRow['last_updated'];

                echo '<p class="box-content">' . number_format($totaltools, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';
                ?>
                </div>

                <div class="dashboard-box">
                <h3 class="box-title">Declined Applicants</h3>
                <?php   
                $totaleduQuery = "SELECT COUNT(*) AS total_edu, MAX(date_change) AS last_updated FROM applicants WHERE status = 'Declined'";
                $totaleduResult = $conn->query($totaleduQuery);
                $totaleduRow = $totaleduResult->fetch_assoc();
                $totaledu = $totaleduRow['total_edu'];
                $lastUpdated = $totaleduRow['last_updated'];

                echo '<p class="box-content">' . number_format($totaledu, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';
                ?>
                </div>

                <div class="dashboard-box">
                <h3 class="box-title">Archived Applicants</h3>
                <?php   
                $totalborrowsQuery = "SELECT COUNT(*) AS total_borrows, MAX(date_change) AS last_updated FROM applicants WHERE status = 'Archived'";
                $totalborrowsResult = $conn->query($totalborrowsQuery);
                $totalborrowsRow = $totalborrowsResult->fetch_assoc();
                $totalborrows = $totalborrowsRow['total_borrows'];
                $lastUpdated = $totalborrowsRow['last_updated'];

                echo '<p class="box-content">' . number_format($totalborrows, 0) . '</p>';
                $formattedDate = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate . '</p>';               ?>
                </div>
            </div>
        </div>

        
        <!-- /page content -->

        <!-- footer content -->
        <footer id="mainFooter">
            &copy; Copyright 2023 | Online Special Program for Employment of Student (SPES)
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