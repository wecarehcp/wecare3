<?php
// Initialize session
session_start();

// Check if payment details are set in the session
if (!isset($_SESSION['payment_details'])) {
    // Redirect to the checkout page if no payment details found
    header("Location: checkout.php");
    exit();
}

// Clear session data
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('22222.jpg'); /* Replace with the path to your image */
            background-size: cover;
            background-position: center;
        }

        .confirmation-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .confirmation-card {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkmark-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
        }

        .checkmark {
            color: white;
            font-size: 24px;
        }

        h2 {
            margin: 0 0 10px;
            color: #333;
        }

        p {
            margin: 0 0 20px;
            color: #666;
        }

        .done-button {
            background-color: #ccc;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .done-button:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="confirmation-card">
            <div class="checkmark-circle">
                <span class="checkmark">✔</span>
            </div>
            <h2>Your Order is Confirmed!</h2>
            <p>Thanks For Your Order</p>
            <button class="done-button">DONE</button>
        </div>
    </div>
</body>
</html>