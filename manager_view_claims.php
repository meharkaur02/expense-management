<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager View Claims</title>
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
        .action-buttons {
            margin-top: 20px;
        }
        .action-buttons button {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }
        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }
        .reject-btn {
            background-color: #f44336;
            color: white;
        }
        .refer-btn {
            background-color: #ff9800;
            color: white;
        }
    </style>
</head>
<body>
    <div class="claims-list">
        <h2>Manager View Claims</h2>
        <table>
            <thead>
                <tr>
                    <th>Claim ID</th>
                    <th>Employee Code</th>
                    <th>Expense Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                if (!isset($_SESSION['logged_in']) || !isset($_SESSION['is_manager']) || $_SESSION['logged_in'] !== true || $_SESSION['is_manager'] !== true) {
                    header("Location: login.html");
                    exit();
                }

                $servername = "localhost";
                $username = "username";
                $password = "password";
                $dbname = "your_database";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM claims";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['claim_id'] . "</td>";
                        echo "<td>" . $row['employee_code'] . "</td>";
                        echo "<td>" . $row['expense_type'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>$" . $row['amount'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td class='action-buttons'>";
                        echo "<form action='process_claim.php' method='post'>";
                        echo "<input type='hidden' name='claim_id' value='" . $row['claim_id'] . "'>";
                        echo "<button type='submit' name='action' value='approve' class='approve-btn'>Approve</button>";
                        echo "<button type='submit' name='action' value='reject' class='reject-btn'>Reject</button>";
                        echo "<button type='submit' name='action' value='refer' class='refer-btn'>Refer Back</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No claims found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
