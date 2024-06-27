<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Care</title>
    <link rel="stylesheet" href="style5.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            background-image: url('22222.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 30%;
            margin: 9px auto;
            background-color: #bec7bf;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(239, 220, 220, 0.1);
        }

        h1, h2, h3 {
            text-align: center;
            color: #fff;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        input[type="date"],
        input[type="time"],
        select {
            width: 90%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        .back-button {
            width: 50%;
            background-color: #333;
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

        input[type="submit"]:hover,
        .back-button:hover {
            background-color: #bec7bf;
        }
        .success-message {
            display: none;
            color: darkslategrey;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Your Appointment</h2>
        <form id="appointmentForm" method="post" action="">
            <b><label for="governorate">Select Governorate:</label></b>
            <select id="governorate" name="governorate">
                <option value="Muscat">Muscat</option>
                <option value="Ad Dakhiliyah">Ad Dakhiliyah</option>
                <option value="Ad Dhahirah">Ad Dhahirah</option>
                <option value="Dhofar">Dhofar</option>
                <option value="Al Buraimi">Al Buraimi</option>
                <option value="Al Batinah">Al Batinah</option>
                <option value="Al Wusta">Al Wusta</option>
                <option value="Ash Sharqiyah">Ash Sharqiyah</option>
            </select>

            <b><label for="hospital">Select Hospital/Clinic:</label></b>
            <select id="hospital" name="hospital">
                <option value="Badder Alsamma hospital">Badder Alsamma hospital</option>
                <option value="Magshin Clinic">Magshin Clinic</option>
                <option value="Alkhoud Health Center">Alkhoud Health Center</option>
            </select>

            <b><label for="clinicType">Select Clinic Type:</label></b>
            <select id="clinicType" name="clinicType">
                <option value="Cardiology">Cardiology</option>
                <option value="Orthopedics">Orthopedics</option>
                <option value="Dentistry">Dentistry</option>
                <option value="Dermatology">Dermatology</option>
                <option value="Hematology">Hematology</option>
                <option value="Oncology">Oncology</option>
                <option value="Psychiatry">Psychiatry</option>
                <option value="Surgery">Surgery</option>
            </select>
            
            <b><label for="doctor">Select Doctor:</label></b>
            <select id="doctor" name="doctor">
                <option value="Ali12">Dr. Ali</option>
                <option value="rashid123">Dr. Rashid</option>
                <option value="Husain1234">Dr. Husain</option>
            </select>

            <b><label for="appointmentDate">Select Date:</label></b>
            <input type="date" id="appointmentDate" name="appointmentDate">
            <b><label for="appointmentTime">Select Time:</label></b>
            <input type="time" id="appointmentTime" name="appointmentTime">
            <input type="submit" value="Book Appointment">
        </form>
        <a href="https://localhost/We%20care/" class="back-button">Back to Home Page</a>
    </div>
    <div class="success-message" id="successMessage">
            Appointment Booked successfully!
        </div>
    </div>
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

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $governorate = $_POST['governorate'];
        $clinicType = $_POST['clinicType'];
        $hospital = $_POST['hospital'];
        $doctor = $_POST['doctor'];
        $appointmentDate = $_POST['appointmentDate'];
        $appointmentTime = $_POST['appointmentTime'];

        $sql = "INSERT INTO appointments (governorate, clinic_type, hospital, doctor, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $governorate, $clinicType, $hospital, $doctor, $appointmentDate, $appointmentTime);

        if ($stmt->execute()) {
            echo "<script>alert('Appointment booked successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>

    <script>
        $(document).ready(function(){
            $('#clinicType').change(function(){
                var clinicTypeId = $(this).val();
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: {clinicTypeId: clinicTypeId},
                    dataType: 'json',
                    success: function(response){
                        $('#hospital').empty();
                        $.each(response, function(key, value) {
                            $('#hospital').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            });

            $('#hospital').change(function(){
                var hospitalId = $(this).val();
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: {hospitalId: hospitalId},
                    dataType: 'json',
                    success: function(response){
                        $('#doctor').empty();
                        $.each(response, function(key, value) {
                            $('#doctor').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
