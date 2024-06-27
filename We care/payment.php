<?php
// Initialize session
session_start();

// Check if shipping details are set in the session
if (!isset($_SESSION['shipping_details'])) {
    // Redirect to the checkout page if no shipping details found
    header("Location: checkout.php");
    exit();
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card_number = $_POST['card_number'];
    $exp_date = $_POST['exp_date'];
    $cvv = $_POST['cvv'];

    // Save payment details to the session or process payment
    $_SESSION['payment_details'] = [
        'card_number' => $card_number,
        'exp_date' => $exp_date,
        'cvv' => $cvv
    ];

    // Redirect to a confirmation page
    header("Location: thank_you.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('22222.jpg'); /* Replace with the path to your background image */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 2em;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form .form-group {
            margin-bottom: 1.5em;
        }

        form .form-group label {
            display: block;
            margin-bottom: 0.5em;
            font-weight: bold;
            color: #333;
        }

        form .form-group input {
            width: calc(100% - 24px);
            padding: 0.75em 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        button {
            width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 4px;
            background-color: #333;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        .image-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .image-container img {
            max-width: 100%;
            height:3;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="pay.png" alt="Descriptive Alt Text">
        </div>
        <form method="post" action="">
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="exp_date">Expiration Date</label>
                <input type="text" id="exp_date" name="exp_date" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <button type="submit">Submit Payment</button>
        </form>
    </div>
</body>
</html>
