<?php
// Initialize session
session_start();

// Check if shipping details are set in the session
if (!isset($_SESSION['shipping_details'])) {
    // Redirect to the checkout page if no shipping details found
    header("Location: checkout.php");
    exit();
}

$shipping_details = $_SESSION['shipping_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        /* Reset some default styles */
        body, h2, h3, p, form, button {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Basic styling for the body and header */
        body {
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h2 {
            color: #4CAF50;
            font-size: 2rem;
        }

        /* Container for the main content */
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h3 {
            margin-bottom: 15px;
            color: #555;
            font-size: 1.5rem;
        }

        .shipping-info p {
            margin: 10px 0;
        }

        .shipping-info p strong {
            color: #333;
        }

        /* Styling for the buttons */
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #f44336;
        }

        .btn-secondary:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <header>
        <h2>Order Confirmation</h2>
    </header>
    <div class="container">
        <h3>Shipping Details</h3>
        <div class="shipping-info">
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($shipping_details['name']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($shipping_details['address']); ?></p>
            <p><strong>Street Name or Number:</strong> <?php echo htmlspecialchars($shipping_details['street_name']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($shipping_details['city']); ?></p>
            <p><strong>State:</strong> <?php echo htmlspecialchars($shipping_details['state']); ?></p>
        </div>
        <div class="buttons">
            <form method="post" action="payment.php">
                <button type="submit" class="btn"><a href="https://localhost/We%20care/payment.php">Proceed to Payment</a></button>
            </form>
            <form method="post" action="checkout.php">
                <button type="submit" class="btn btn-secondary">Edit Details</button>
            </form>
        </div>
    </div>
</body>
</html>