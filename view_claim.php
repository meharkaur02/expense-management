<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Claims</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin-top: 50px;
        }
        .claims-list {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .claims-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .claims-list table th,
        .claims-list table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        .claims-list table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="claims-list">
        <h2>My Claims</h2>
        <table>
            <thead>
                <tr>
                    <th>Claim ID</th>
                    <th>Expense Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Start session to retrieve employee code
                session_start();

                // Check if user is logged in
                if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                    header("Location: login.html");
                    exit();
                }

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

                // Retrieve employee code from session
                $employeeCode = $_SESSION['employee_code'];

                // Query to fetch claims for the logged-in user
                $sql = "SELECT * FROM claims WHERE employee_code='$employeeCode'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['claim_id'] . "</td>";
                        echo "<td>" . $row['expense_type'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>$" . $row['amount'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No claims found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
