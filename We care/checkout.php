<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0;
            font-size: 24px;
            color: #333333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }

        .form-group input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333333;
        }

        .form-group input:focus {
            border-color: #777777;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>Checkout</h2>
        </header>
        <?php
        // Initialize session
        session_start();

        // Database connection parameters
        $servername = "localhost";
        $username = "root"; // Change to your database username
        $password = ""; // Change to your database password
        $dbname = "wecare";

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $name = $conn->real_escape_string($_POST['name']);
            $phone_number = $conn->real_escape_string($_POST['phone_number']);
            $address = $conn->real_escape_string($_POST['address']);
            $street_name = $conn->real_escape_string($_POST['street_name']);
            $city = $conn->real_escape_string($_POST['city']);
            $state = $conn->real_escape_string($_POST['state']);

            // Insert shipping details into the database
            $sql = "INSERT INTO shipping_details (name, phone_number, address, street_name, city, state) VALUES ('$name', '$phone_number', '$address', '$street_name', '$city', '$state')";

            if ($conn->query($sql) === TRUE) {
                // Save shipping details to the session
                $_SESSION['shipping_details'] = [
                    'name' => $name,
                    'phone_number' => $phone_number,
                    'address' => $address,
                    'street_name' => $street_name,
                    'city' => $city,
                    'state' => $state
                ];

                // Redirect to a confirmation or payment page
                header("Location: confirmation.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="street_name">Street Name or Number:</label>
                <input type="text" id="street_name" name="street_name" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
