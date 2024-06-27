<?php
// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the query to check if the username and password match
    $stmt = $conn->prepare("SELECT * FROM userss WHERE Username = ? AND User_password = ?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['user_id']; // Store user ID in session
        $_SESSION['role'] = $user['role']; // Store user role in session

        // Redirect to a welcome page or dashboard
        header("Location: index.php");
        exit(); // Terminate the script after redirection
    } else {
        // Invalid username or password
        $error_message = "Invalid username or password.";
    }

    // Close statement and connection
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
            border-radius: 10px;
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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
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

        p.message {
            text-align: center;
        }

        p.error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            <?php
            // Display error message if login failed
            if (isset($error_message)) {
                echo '<p class="error">' . $error_message . '</p>';
            }
            ?>
        </form>
    </div>
</body>
</html>