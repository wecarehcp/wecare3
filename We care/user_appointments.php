<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Appointments</title>
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
            width: 50%;
            margin: 20px auto;
            background-color: rgba(240, 240, 240, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h3 {
            text-align: center;
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

        input[type="submit"], .back-button {
            width: 50%;
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

        input[type="submit"]:hover, .back-button:hover {
            background-color: #bec7bf;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Your Booked Appointments</h3>
        <table>
            <tr>
                <th>Governorate</th>
                <th>Clinic Type</th>
                <th>Hospital</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            // config.php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "wecare";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM appointments";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["governorate"]. "</td><td>" . $row["clinic_type"]. "</td><td>" . $row["hospital"]. "</td><td>" . $row["doctor"]. "</td><td>" . $row["appointment_date"]. "</td><td>" . $row["appointment_time"]. "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No appointments found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <a href="https://localhost/We%20care/" class="back-button">Back to Home Page</a>
    </div>
</body>
</html>
