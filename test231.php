<?php
// Start a PHP session (if not already started)
session_start();

// Database connection details
$databaseHost = 'localhost';
$databaseUsername = 'root';
$databasePassword = '';
$dbname = "spes_db";

// Create a new MySQLi connection
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $dbname);

// Check for a successful connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user data exists in session, then populate the form fields
if (isset($_SESSION['user_data'])) {
    $userData = $_SESSION['user_data'];
} else {
    // If no user data found, initialize an empty array
    $userData = array();
}

// Check if user data is available in the session
$first_Name = isset($_SESSION['user_data']['first_Name']) ? $_SESSION['user_data']['first_Name'] : '';
$middle_Name = isset($_SESSION['user_data']['middle_Name']) ? $_SESSION['user_data']['middle_Name'] : '';
$last_Name = isset($_SESSION['user_data']['last_Name']) ? $_SESSION['user_data']['last_Name'] : '';
$suffix = isset($_SESSION['user_data']['suffix']) ? $_SESSION['user_data']['suffix'] : '';
$birthday = isset($_SESSION['user_data']['birthday']) ? $_SESSION['user_data']['birthday'] : '';

// Handle form submission for both 'Next' and 'Update'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'next' or 'update' button was clicked
    if (isset($_POST["next"])) {
        // Handle 'Next' button submission
        $validationError = validateFormData($_POST);

        $_SESSION['user_data'] = $_POST;

        if (!$validationError) {
            $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

            $inserted = insertApplicantData($conn, $_POST, $user_id);

            if ($inserted) {
                unset($_SESSION['user_data']); // Unset the user_data session variable
                header("Location: pre_emp_doc.php");
                exit;
            } else {
                echo '<script>alert("Registration failed. Please try again later.");</script>';
            }
        } else {
            echo '<script>alert("Validation error: ' . $validationError . '");</script>';
        }
    } elseif (isset($_POST["update"])) {
        // Handle 'Update' button submission
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        $updated = updateApplicantData($conn, $_POST, $user_id);

        if ($updated) {
            // Data updated successfully
            // Redirect or perform further actions
        } else {
            echo '<script>alert("Update failed. Please try again later.");</script>';
        }
    }
}

// Function to validate form data
function validateFormData($formData) {
    // Implement your validation logic here
    // Return an error message as a string if validation fails, or return false if it passes
}
// Function to insert data into the database using prepared statements
function insertApplicantData($connection, $formData, $user_id) {
    // Assuming 'user_id' is a field in your 'applicants' table
    $fields = [
        'user_id', 'type_Application', 'first_Name', 'middle_Name', 'last_Name', 'birthday', 'place_of_birth', 'citizenship',
        'mobile_no', 'email', 'civil_status', 'sex', 'spes_type', 'parent_status', 'parents_displaced',
        'no_street', 'province_id', 'city_municipality_id', 'barangay_id', 'no_street2', 'province_id2',
        'city_municipality_id2', 'barangay_id2', 'father_first_name', 'father_middle_name',
        'father_last_name', 'father_contact_no', 'mother_first_name', 'mother_middle_name',
        'mother_last_name', 'mother_contact_no', 'elem_name', 'year_grade_level',
        'elem_date_attendance', 'hs_name', 'hs_degree', 'hs_year_level', 'hs_date_attendance',
        'suc_name', 'suc_course', 'suc_year_level', 'suc_date_attendance', 'status', 'spes_times'
    ];

    // Prepare the SQL statement with placeholders
    $placeholders = implode(', ', array_fill(0, count($fields), '?'));
    $sql = "INSERT INTO applicants (" . implode(", ", $fields) . ") VALUES ($placeholders)";

    $stmt = $connection->prepare($sql);

    // Check for SQL statement preparation errors
    if ($stmt === false) {
        return false;
    }

    // Create the types string for binding parameters
    $types = str_repeat("s", count($fields));

    // Bind parameters dynamically
    $bindParams = [&$types];
    if ($user_id !== null) {
        $bindParams[] = &$user_id;
    }
    foreach ($fields as $field) {
        if ($field !== 'user_id') { // Exclude 'user_id' field
            $bindParams[] = &$formData[$field];
        }
    }

    // Bind parameters to the prepared statement
    call_user_func_array([$stmt, 'bind_param'], $bindParams);

    // Execute the prepared statement
    $result = $stmt->execute();

    return $result;
}
// Function to update data in the database using prepared statements
function updateApplicantData($connection, $formData, $user_id) {
    // Assuming 'user_id' is a field in your 'applicants' table
    $fields = [
        'type_Application', 'first_Name', 'middle_Name', 'last_Name', 'birthday', 'place_of_birth', 'citizenship',
        'mobile_no', 'email', 'civil_status', 'sex', 'spes_type', 'parent_status', 'parents_displaced',
        'no_street', 'province_id', 'city_municipality_id', 'barangay_id', 'no_street2', 'province_id2',
        'city_municipality_id2', 'barangay_id2', 'father_first_name', 'father_middle_name',
        'father_last_name', 'father_contact_no', 'mother_first_name', 'mother_middle_name',
        'mother_last_name', 'mother_contact_no', 'elem_name', 'year_grade_level',
        'elem_date_attendance', 'hs_name', 'hs_degree', 'hs_year_level', 'hs_date_attendance',
        'suc_name', 'suc_course', 'suc_year_level', 'suc_date_attendance', 'status', 'spes_times'
    ];

    // Prepare the SQL statement to update fields
    $updateFields = [];
    foreach ($fields as $field) {
        if (isset($formData[$field])) {
            $updateFields[] = "$field = ?";
        }
    }
    $updateFieldsString = implode(", ", $updateFields);

    // Prepare the SQL update statement
    $sql = "UPDATE applicants SET $updateFieldsString WHERE user_id = ?";
    $stmt = $connection->prepare($sql);

    // Check for SQL statement preparation errors
    if ($stmt === false) {
        return false;
    }

    // Create the types string for binding parameters
    $types = "";
    $bindParams = [&$types];
    foreach ($fields as $field) {
        if (isset($formData[$field])) {
            $types .= "s"; // Assuming all fields are strings, adjust if needed
            $bindParams[] = &$formData[$field];
        }
    }
    $bindParams[] = &$user_id;

    // Bind parameters to the prepared statement
    call_user_func_array([$stmt, 'bind_param'], $bindParams);

    // Execute the prepared statement
    $result = $stmt->execute();

    return $result;
}


// Close the database connection
$conn->close();
?>
