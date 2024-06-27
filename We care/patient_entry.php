<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Data Entry</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Patient Data Entry</h1>
    </header>
    <main>
        <form action="submit_patient.php" method="post">
            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required><br>

            <!-- Add other input fields for patient data here -->

            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>
