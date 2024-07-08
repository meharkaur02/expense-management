<?php
session_start();

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['is_manager']) || $_SESSION['logged_in'] !== true || $_SESSION['is_manager'] !== true) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $claimID = $_POST['claim_id'];
    $action = $_POST['action'];


    switch ($action) {
        case 'approve':
            $status = "Approved";
            break;
        case 'reject':
            $status = "Rejected";
            break;
        case 'refer':
            $status = "Refer Back";
            break;
        default:
            $status = "Submitted";
            break;
    }

    $sql = "UPDATE claims SET status='$status' WHERE claim_id='$claimID'";

    if ($conn->query($sql) === TRUE) {
        echo "Claim status updated successfully.";
    } else {
        echo "Error updating claim status: " . $conn->error;
    }

    $conn->close();
}
?>
