<?php
// Connect to the database (replace with your database credentials)
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'spes_db';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$first_Name = $_POST['first_Name'];
$middle_Name = $_POST['middle_Name'];
$last_Name = $_POST['last_Name'];
$birthday = $_POST['birthday'];
$place_of_birth = $_POST['place_of_birth'];
$citizenship = $_POST['citizenship'];
$mobile_no = $_POST['mobile_no'];
$email = $_POST['email'];
$civil_status = $_POST['civil_status'];
$sex = $_POST['sex'];
$spes_type = $_POST['spes_type'];
$parent_status = $_POST['parent_status'];
$parents_displaced = $_POST['parents_displaced'];
$no_street = $_POST['no_street'];
$province_id = $_POST['province_id'];
$city_municipality_id = $_POST['city_municipality_id'];
$barangay_id = $_POST['barangay_id'];
$no_street2 = $_POST['no_street2'];
$province_id2 = $_POST['province_id2'];
$city_municipality_id2 = $_POST['city_municipality_id2'];
$barangay_id2 = $_POST['barangay_id2'];
$father_first_name = $_POST['father_first_name'];
$father_middle_name = $_POST['father_middle_name'];
$father_last_name = $_POST['father_last_name'];
$father_contact_no = $_POST['father_contact_no'];
$mother_first_name = $_POST['mother_first_name'];
$mother_middle_name = $_POST['mother_middle_name'];
$mother_last_name = $_POST['mother_last_name'];
$mother_contact_no = $_POST['mother_contact_no'];
$elem_name = $_POST['elem_name'];
$year_grade_level = $_POST['year_grade_level'];
$elem_date_attendance = $_POST['elem_date_attendance'];
$hs_name = $_POST['hs_name'];
$hs_degree = $_POST['hs_degree'];
$hs_year_level = $_POST['hs_year_level'];
$hs_date_attendance = $_POST['hs_date_attendance'];
$suc_name = $_POST['suc_name'];
$suc_course = $_POST['suc_course'];
$suc_year_level = $_POST['suc_year_level'];
$suc_date_attendance = $_POST['suc_date_attendance'];
$spes_times = $_POST['spes_times'];
$status = 'pending';

// Insert data into the database
$sql = "INSERT INTO applicants (first_Name, middle_Name, last_Name, birthday, place_of_birth, citizenship, mobile_no, email, civil_status, sex, spes_type, parent_status, parents_displaced, no_street, province_id, city_municipality_id, barangay_id, no_street2, province_id2, city_municipality_id2, barangay_id2, father_first_name, father_middle_name, father_last_name, father_contact_no, mother_first_name, mother_middle_name, mother_last_name, mother_contact_no, elem_name, year_grade_level, elem_date_attendance, hs_name, hs_degree, hs_year_level, hs_date_attendance, suc_name, suc_course, suc_year_level, suc_date_attendance, spes_times, status)
VALUES ('$first_Name', '$middle_Name', '$last_Name', '$birthday', '$place_of_birth', '$citizenship', '$mobile_no', '$email', '$civil_status', '$sex', '$spes_type', '$parent_status', '$parents_displaced', '$no_street', '$province_id', '$city_municipality_id', '$barangay_id', '$no_street2', '$province_id2', '$city_municipality_id2', '$barangay_id2', '$father_first_name', '$father_middle_name', '$father_last_name', '$father_contact_no', '$mother_first_name', '$mother_middle_name', '$mother_last_name', '$mother_contact_no', '$elem_name', '$year_grade_level', '$elem_date_attendance', '$hs_name', '$hs_degree', '$hs_year_level', '$hs_date_attendance', '$suc_name', '$suc_course', '$suc_year_level', '$suc_date_attendance', '$spes_times', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
