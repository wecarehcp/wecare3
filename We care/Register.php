<?php
// Enable error reporting for debugging
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$registration_message = ""; 
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "wecare";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO userss (Full_Name, Username, Phone_Number, Email, User_password, role) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $full_name, $username, $phone_number, $email, $password, $role);

    // Set parameters
    $full_name = $_POST['Full_Name'];
    $username = $_POST['Username'];
    $phone_number = $_POST['Phone_Number'];
    $email = $_POST['Email'];
    $password = $_POST['User_password']; // Store password as plaintext (not recommended)
    $role = $_POST['role'];

    // Check if username or email already exists
    $check_stmt = $conn->prepare("SELECT * FROM userss WHERE Username = ? OR Email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $error_message = "Username or Email already exists.";
    } else {
        if ($stmt->execute()) {
            $registration_message = "New record created successfully";
        } else {
            $error_message = "Error executing statement: " . $stmt->error;
        }
    }

    $check_stmt->close();
    $stmt->close();
    $conn->close();
}
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
            margin: 0;
            padding: 0;
        }

        .login-container {
            background-image: url('22222.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #login-form {
            background-color: rgba(255, 255, 255, 0.8); /* semi-transparent white background */
            padding: 60px;
            border-radius: 2px;
        }

        h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #0c0b0b;
            border-radius: 5px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #555;
        }

        p.error {
            color: darkblue;
            text-align: center;
        }

        p.success {
            color: darkblue;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Register</h2>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="Full_Name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="Username" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" id="phone_number" name="Phone_Number" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="User_password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="doctor">Doctor</option>
                </select>
            </div>
            <button type="submit">Create</button>
            <?php if (!empty($registration_message)): ?>
                <p class="success"><?php echo $registration_message; ?></p>
            <?php endif; ?>
            <?php if (!empty($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <p class="message">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>

