<?php
// Initialize the success message variable
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
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

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO patients (patient_name, patient_id, phone, reserve_number, nationality, dob, age, gender, blood_type, chronic_diseases, current_medications, allergies, previous_surgeries, vaccinations, family_diseases) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sissssissssssss", $patient_name, $patient_id, $phone, $reserve_number, $nationality, $dob, $age, $gender, $blood_type, $chronic_diseases, $current_medications, $allergies, $previous_surgeries, $vaccinations, $family_diseases);

    // Set parameters and execute
    $patient_name = $_POST['patient_name'];
    $patient_id = $_POST['patient_id'];
    $phone = $_POST['phone'];
    $reserve_number = $_POST['reserve_number'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $blood_type = $_POST['blood_type'];
    $chronic_diseases = $_POST['chronic_diseases'];
    $current_medications = $_POST['current_medications'];
    $allergies = $_POST['allergies'];
    $previous_surgeries = $_POST['previous_surgeries'];
    $vaccinations = $_POST['vaccinations'];
    $family_diseases = $_POST['family_diseases'];

    if ($stmt->execute()) {
        $successMessage = "New patient added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('22222.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            max-width: 600px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Adding opacity */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            flex: 1;
            padding: 0 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        button[type="submit"],
        .back-btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover,
        .back-btn:hover {
            background-color: #ccc;
        }

        .back-btn {
            background-color: #333;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            color: white;
        }

        .success-message {
            text-align: center;
            color:darkslategrey;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form id="add-patient-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Add Patient</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                </div>
                <div class="form-group">
                    <label for="patient_id">Patient ID</label>
                    <input type="number" id="patient_id" name="patient_id" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="reserve_number">Reserve Number</label>
                    <input type="text" id="reserve_number" name="reserve_number" required>
                </div>
                <div class="form-group">
                    <label for="nationality">Nationality</label>
                    <input type="text" id="nationality" name="nationality" required>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="text" id="gender" name="gender" required>
                </div>
                <div class="form-group">
                    <label for="blood_type">Blood Type</label>
                    <input type="text" id="blood_type" name="blood_type" required>
                </div>
            </div>
            <div class="form-group">
                <label for="chronic_diseases">Chronic Diseases</label>
                <textarea id="chronic_diseases" name="chronic_diseases"></textarea>
            </div>
            <div class="form-group">
                <label for="current_medications">Current Medications</label>
                <textarea id="current_medications" name="current_medications"></textarea>
            </div>
            <div class="form-group">
                <label for="allergies">Allergies</label>
                <textarea id="allergies" name="allergies"></textarea>
            </div>
            <div class="form-group">
                <label for="previous_surgeries">Previous Surgeries</label>
                <textarea id="previous_surgeries" name="previous_surgeries"></textarea>
            </div>
            <div class="form-group">
                <label for="vaccinations">Vaccinations</label>
                <textarea id="vaccinations" name="vaccinations"></textarea>
            </div>
            <div class="form-group">
                <label for="family_diseases">Family Diseases</label>
                <textarea id="family_diseases" name="family_diseases"></textarea>
            </div>
            <button type="submit">Add Patient</button>
            <a href="https://localhost/We%20care/" class="back-btn">Back to Home Page</a>
        </form>
        <?php if (!empty($successMessage)): ?>
        <div class="success-message">
            <p><?php echo $successMessage; ?></p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>