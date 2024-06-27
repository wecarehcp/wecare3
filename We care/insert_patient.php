<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // if your MySQL password is empty
$dbname = "wecare";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
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

    // Prepare and execute the query to insert data into the patients table
    $stmt = $conn->prepare("INSERT INTO patients (patient_id, patient_name, phone, reserve_number, nationality, dob, age, gender, blood_type, chronic_diseases, current_medications, allergies, previous_surgeries, vaccinations, family_diseases) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("issssssisssssss", $patient_id, $patient_name, $phone, $reserve_number, $nationality, $dob, $age, $gender, $blood_type, $chronic_diseases, $current_medications, $allergies, $previous_surgeries, $vaccinations, $family_diseases);
    
    if ($stmt->execute()) {
        echo "New patient added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
