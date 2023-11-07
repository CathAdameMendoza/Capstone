<?php
if (isset($_POST['id'])) {
    $recipientId = $_POST['id'];

    // Connect to your database and execute a query to fetch the email address based on $recipientId
    // Store the email address in $recipientEmail

    // Return the email address as JSON
    echo json_encode(['email' => $recipientEmail]);
} else {
    echo json_encode(['email' => null]); // Return null or an empty string if no email is found
}
?>
