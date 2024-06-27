<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Care</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:300);

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('22222.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: flex-start; /* Align content to the left */
            align-items: center;
        }

        .container {
            padding-top: 80px; /* Adjust according to header height */
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start; /* Align buttons to the left */
            align-items: flex-start; /* Align buttons to the top */
            margin-left: 20px; /* Add some margin to the left */
        }

        button {
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
            width: 200px; /* Set a fixed width for all buttons */
            text-align: center; /* Center the text inside the button */
        }

        button:hover {
            transform: scale(1.1);
        }

        button img {
            width: 100px;
            height: 100px;
        }

        .signout {
            position: absolute;
            top: 15px;
            right: 15px;
        }
    </style>
</head>

<body>
    <?php
    // Start the session
    session_start();

    // Check if the user is logged in and retrieve their role
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit();
    }

    $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
    ?>

    <!-- Sign-out link -->
    <div class="signout">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
        <a href="signout.php">Sign Out</a>
        <?php endif; ?>
    </div>

    <div class="container">
        <?php if ($role !== 'doctor'): ?>
        <a href="https://localhost/We%20care/emergency.php">
            <button id="emergency">
                <img src="EM.jpg" alt="Emergency Icon">
                <h2>Emergency</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/products1.php">
            <button id="pharmacy">
                <img src="PH.jpg" alt="Pharmacy Icon">
                <h2>Pharmacy</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/Appointment.php">
            <button id="appointment">
                <img src="APP.jpg" alt="Appointment Icon">
                <h2>Appointment</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/About%20You.php">
            <button id="about-you">
                <img src="AY.jpg" alt="About You Icon">
                <h2>About You</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/user_appointments.php">
            <button id="your-appointment">
                <img src="APP.jpg" alt="Your Appointment Icon">
                <h2>Your Appointment</h2>
            </button>
        </a>
        <?php endif; ?>

        <?php if ($role === 'doctor'): ?>
        <a href="https://localhost/We%20care/add_patient.php">
            <button id="add-patient">
                <img src="AY.jpg" alt="Add Patient Icon">
                <h2>Add Patient</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/doctor_appointments.php">
            <button id="doctor-appointments">
                <img src="APP.jpg" alt="Doctor Appointment Icon">
                <h2>Dr Appointment</h2>
            </button>
        </a>
        <a href="https://localhost/We%20care/add_product.php">
            <button id="pharmacy">
                <img src="PH.jpg" alt="Pharmacy Icon">
                <h2>Add products</h2>
            </button>
        </a>
        <?php endif; ?>
    </div>
</body>

</html>