<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wecare";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user ID from session
$user_id = $_SESSION['user_id'];

// Fetch patient data using user ID
$sql = "SELECT * FROM patients WHERE patient_id = (SELECT patient_id FROM userss WHERE user_id = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No patient information found";
    exit();
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Care</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:300');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f7f7f7;
            background-image: url('22222.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        main {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 10px;
            max-width: 600px;
        }

        .patient-profile {
            display: flex;
            align-items: center;
        }

        .patient-profile img {
            border-radius: 50%;
            width: 100px; /* Adjust size as needed */
            height: 100px; /* Adjust size as needed */
            margin-right: 20px;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        .back-button {
            display:list-item;
            justify-content: center;
            margin-top: 20px;
        }

        .back-button a {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-button a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <main>
        <section class="patient-info">
            <h2>Patient Information</h2>
            <div class="patient-profile">
                <img src="AY.jpg" alt="Patient Picture">
                <ul>
                    <li><strong>Patient Name:</strong> <?php echo $row['patient_name']; ?></li>
                    <li><strong>Patient ID:</strong> <?php echo $row['patient_id']; ?></li>
                    <li><strong>Phone:</strong> <?php echo $row['phone']; ?></li>
                    <li><strong>Reserve Number:</strong> <?php echo $row['reserve_number']; ?></li>
                    <li><strong>Nationality:</strong> <?php echo $row['nationality']; ?></li>
                    <li><strong>Date of Birth:</strong> <?php echo $row['dob']; ?></li>
                    <li><strong>Age:</strong> <?php echo $row['age']; ?></li>
                    <li><strong>Gender:</strong> <?php echo $row['gender']; ?></li>
                    <li><strong>Blood Type:</strong> <?php echo $row['blood_type']; ?></li>
                </ul>
            </div>
        </section>
        <section class="medical-history">
            <h2>Medical History</h2>
            <ul>
                <li><strong>Chronic Diseases:</strong> <?php echo $row['chronic_diseases']; ?></li>
                <li><strong>Current Medications:</strong> <?php echo $row['current_medications']; ?></li>
                <li><strong>Allergies:</strong> <?php echo $row['allergies']; ?></li>
                <li><strong>Previous Surgeries:</strong> <?php echo $row['previous_surgeries']; ?></li>
                <li><strong>Vaccinations:</strong> <?php echo $row['vaccinations']; ?></li>
                <li><strong>Family Diseases:</strong> <?php echo $row['family_diseases']; ?></li>
            </ul>
        </section>
        <div class="back-button">
            <a href="https://localhost/We%20care/">Back to Homepage</a>
        </div>
    </main>
</body>
</html>
