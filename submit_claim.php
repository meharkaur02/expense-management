<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    // Establishing connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize user input
    $employeeCode = $_SESSION['employee_code']; // Assuming you stored this in the session during login
    $expenseType = $conn->real_escape_string($_POST['expenseType']);
    $description = $conn->real_escape_string($_POST['description']);
    $amount = $_POST['amount'];

    // Insert claim into database
    $sql = "INSERT INTO claims (employee_code, expense_type, description, amount) 
            VALUES ('$employeeCode', '$expenseType', '$description', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo "Claim submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
