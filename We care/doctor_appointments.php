<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointments</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-image: url('22222.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: rgba(240, 240, 240, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #7d7c7c;
            color: #fff;
        }

        td {
            background-color: #fff;
        }

        .back-button {
            width: 150px;
            background-color: #7d7c7c;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            text-align: center;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #bec7bf;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Appointments for Dr. Ali</h3>
        <table>
            <tr>
                <th>Governorate</th>
                <th>Clinic Type</th>
                <th>Hospital</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            // Start the session
            session_start();

            // Check if the user is logged in and is a doctor
            if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'doctor') {
                header("Location: login.php"); // Redirect to login if not logged in
                exit();
            }

            $logged_in_doctor = $_SESSION['username'];

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wecare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM appointments WHERE doctor = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $logged_in_doctor);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["governorate"]. "</td><td>" . $row["clinic_type"]. "</td><td>" . $row["hospital"]. "</td><td>" . $row["appointment_date"]. "</td><td>" . $row["appointment_time"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No appointments found</td></tr>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </table>
        <a class="back-button" href="index.php">Back to Dashboard</a>
    </div>
</body>
</html>
