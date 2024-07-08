<?php
// Start session to persist login state
session_start();

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

    // Retrieve user input
    $employeeCode = $_POST['employeeCode'];
    $password = $_POST['password'];

    // Query to check if user exists with given credentials
    $sql = "SELECT * FROM users WHERE employee_code='$employeeCode' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
        $_SESSION['logged_in'] = true;
        $_SESSION['employee_code'] = $employeeCode;
        header("Location: dashboard.php"); // Redirect to dashboard or another secure page
        exit();
    } else {
        // Invalid credentials
        echo "Invalid Employee Code or Password.";
    }

    $conn->close();
}
?>
