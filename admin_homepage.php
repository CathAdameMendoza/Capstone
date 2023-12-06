<?php 
session_start();
$databaseHost = 'localhost';
$databaseUsername = 'u488180748_BatsCT5PE5';
$databasePassword = 'BatsCT5PE5';
$dbname = "u488180748_BatsCT5PE5";

$conn = new mysqli($databaseHost ,$databaseUsername, $databasePassword, $dbname);
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.6.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="spes_logo.png">
    <style>
            .wrapper{
            
            text-align: center;
            align-items: center;
            align-content: center;
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
            background: #303c54;
            border-radius: 8px;
            padding: 20px ;
            margin-bottom: 20px;
            width: 300px;
            height:140px;
            display: inline-block;
            vertical-align: top;
            margin-left: 30px;
            transition: transform 0.3s ease;
            }
    
            .dashboard-box:hover{
            transform: translateY(-2px);
            background-color: #5d7096;
            }
    
    
            .box-title {
            font-size: 15px;
            margin-bottom: 10px;
            color: #fff;
            }
    
            .box-content {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
            align-content: center;
            justify-self: center;
            }
    
            .box-footer {
            
            margin-top: 10px;
            font-size: 10px;
            color: #ffff;
            }
            .button {
            position: relative;
            width: 150px;
            height: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            border-radius:5px;
            border: 1px solid #303c54;
            background-color: #303c54;
            overflow: hidden;
            }

            .button, .button__icon, .button__text {
            transition: all 0.3s;
            }

            .button .button__text {
            transform: translateX(22px);
            color: #fff;
            font-weight: 600;
            }

            .button .button__icon {
            position: absolute;
            transform: translateX(109px);
            height: 100%;
            width: 39px;
            background-color:#052530;
            display: flex;
            align-items: center;
            justify-content: center;
            }

            .button .svg {
            width: 20px;
            fill: #fff;
            }

            .button:hover {
            background: #303c54;
            }

            .button:hover .button__text {
            color: transparent;
            }

            .button:hover .button__icon {
            width: 148px;
            transform: translateX(0);
            }

            .button:active .button__icon {
            background-color: #146c54;
            }

            .button:active {
            border: 1px solid #146c54;
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
            <button class="button" type="button" onclick="printDashboard()">
                <span class="button__text" >Print Report</span>
                <span class="button__icon" style="color:#fff; font-size:20px;"><i class="ri-printer-line"></i></span>
            </button>


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
                $formattedDate2 = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate2 . '</p>';
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
                $formattedDate3 = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate3 . '</p>';
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
                $formattedDate4 = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate4 . '</p>';
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
                $formattedDate5 = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate5 . '</p>';
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
                $formattedDate6 = date('F j, Y', strtotime($lastUpdated));
                echo '<p class="box-footer">Updated ' . $formattedDate6 . '</p>';               ?>
                </div>




                <script>
                    function printDashboard() {
                        var printWindow = window.open('', '_blank');
                        printWindow.document.write('<html><head><title>SPES Monitoring Report</title></head><body>');

                        // Preload images
                        var logo1 = new Image();
                        logo1.src = 'dole-logo.png';
                        var logo2 = new Image();
                        logo2.src = 'peso-logo.png';
                        var watermark = new Image();
                        watermark.src = 'spes_logo.png';

                        // Function to check if images are loaded
                        function areImagesLoaded() {
                            return logo1.complete && logo2.complete && watermark.complete;
                        }

                        // Function to continue with printing after images are loaded
                        function continuePrinting() {
                            // Logos on the left and right of the centered text
                            printWindow.document.write('<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">');
                            printWindow.document.write('<img src="dole-logo.png" alt="SPES Logo" style="width: 100px; height: auto;">');

                            // Additional Texts Above the Table
                            printWindow.document.write('<div style="text-align: center; line-height: 25%;">');
                            var additionalTexts = [
                                'REPUBLIC OF THE PHILIPPINES',
                                'Department of Labor and Employment',
                                'REGIONAL OFFICE NO. IV-A',
                                'Public Employment Service Office',
                                '_________________________________',
                                'SPECIAL PROGRAM FOR EMPLOYMENT OF STUDENTS',
                                '(RA 7323, as amended by RA 9547 and 10917)'
                            ];
                            for (var i = 0; i < additionalTexts.length; i++) {
                                printWindow.document.write('<p>' + additionalTexts[i] + '</p>');
                            }
                            printWindow.document.write('</div>');

                            // Logos on the right side
                            printWindow.document.write('<img src="peso-logo.png" alt="SPES Logo" style="width: 100px; height: auto;">');
                            printWindow.document.write('</div>');

                            // SPES Monitoring Report Text
                            printWindow.document.write('<h1 style="text-align: center; line-height: 100%;">SPES MONITORING REPORT</h1>');

                            // Table Design
                            printWindow.document.write('<table style="border-collapse: collapse; width: 100%; border: 1px solid black; text-align: center;">');
                            printWindow.document.write('<thead><tr style="border: 1px solid black;">');
                            printWindow.document.write('<th style="border: 1px solid black;">REPORT TYPE</th>');
                            printWindow.document.write('<th style="border: 1px solid black;">TOTAL NUMBER</th>');
                            printWindow.document.write('<th style="border: 1px solid black;">LAST UPDATE</th>');
                            printWindow.document.write('</tr></thead><tbody>');

                            // Function to add a row to the table
                            function addTableRow(title, count, lastUpdated) {
                                printWindow.document.write('<tr style="border: 1px solid black;">');
                                printWindow.document.write('<td style="border: 1px solid black;">' + title + '</td>');
                                printWindow.document.write('<td style="border: 1px solid black;">' + number_format(count, 0) + '</td>');
                                printWindow.document.write('<td style="border: 1px solid black;">' + lastUpdated + '</td>');
                                printWindow.document.write('</tr>');
                            }

                            // Add rows for each dashboard box
                            addTableRow('TOTAL APPLICANTS', <?php echo $totaladmin; ?>, '<?php echo $formattedDate; ?>');
                            addTableRow('NEW APPLICANTS', <?php echo $totalborrower; ?>, '<?php echo $formattedDate2; ?>');
                            addTableRow('RENEWAL APPLICANTS', <?php echo $totalitem; ?>, '<?php echo $formattedDate3; ?>');
                            addTableRow('APPROVED APPLICANTS', <?php echo $totaltools; ?>, '<?php echo $formattedDate4; ?>');
                            addTableRow('DECLINED APPLICANTS', <?php echo $totaledu; ?>, '<?php echo $formattedDate5; ?>');

                            printWindow.document.write('</tbody></table>');

                            // Watermark overlay
                            printWindow.document.write('<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.5;">');
                            printWindow.document.write('<img src="spes_logo.png" alt="Watermark" style="width: 500px; opacity:12%;height: auto;">');
                            printWindow.document.write('</div>');

                            printWindow.document.write('</body></html>');
                            printWindow.document.close();

                            // Close the print window after print or cancel
                            printWindow.onafterprint = function () {
                                printWindow.close();
                            };

                            // Print the content
                            printWindow.print();
                        }

                        // Check if images are loaded, then continue with printing
                        if (areImagesLoaded()) {
                            continuePrinting();
                        } else {
                            // If images are not loaded, wait for them to load before printing
                            watermark.onload = function () {
                                if (areImagesLoaded()) {
                                    continuePrinting();
                                }
                            };
                        }
                    }

                    // Function to format number
                    function number_format(number, decimals, dec_point, thousands_sep) {
                        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                        var n = !isFinite(+number) ? 0 : +number,
                            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                            s = '',
                            toFixedFix = function (n, prec) {
                                var k = Math.pow(10, prec);
                                return '' + Math.round(n * k) / k;
                            };

                        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                        if (s[0].length > 3) {
                            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                        }
                        if ((s[1] || '').length < prec) {
                            s[1] = s[1] || '';
                            s[1] += new Array(prec - s[1].length + 1).join('0');
                        }

                        return s.join(dec);
                    }
                </script>




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