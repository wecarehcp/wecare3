<?php
// Define variables and initialize with empty values
$name = $description = $price = $image = "";
$name_err = $description_err = $price_err = $image_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "wecare");

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter product name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter product description.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate price
    if (empty(trim($_POST["price"]))) {
        $price_err = "Please enter product price.";
    } else {
        $price = trim($_POST["price"]);
    }

    // Validate image
    if (empty($_FILES['image']['name'])) {
        $image_err = "Please select an image.";
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            $image_err = "File is not an image.";
        }
        // Check file size
        elseif ($_FILES["image"]["size"] > 500000) {
            $image_err = "Sorry, your file is too large.";
        }
        // Allow certain file formats
        elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $image_err = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $image_err = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($description_err) && empty($price_err) && empty($image_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO products1 (name, description, price, image) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssds", $param_name, $param_description, $param_price, $param_image);

            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_image = $image;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to product page
                header("location: products1.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body style="background-image: url('22222.jpg'); background-size: cover; display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="wrapper">
        <h2>Add New Product</h2>
        <p>Please fill this form to add a new product to the pharmacy.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                <label>Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                <span class="help-block"><?php echo $price_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                <label>Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
                <span class="help-block"><?php echo $image_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="https://localhost/We%20care/" class="btn btn-default">Back to Home Page</a>
            </div>
        </form>
    </div>
    <div class="success-message" id="successMessage">
            Add Product is successfully!
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 500px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Adding opacity */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .wrapper h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .wrapper p {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: #333;
        }

        .form-control,
        .form-control-file {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #007bff;
        }

        .form-group .help-block {
            color: #d9534f;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-default {
            background-color: #6c757d;
            color: #fff;
        }
        .success-message {
            display: none;
            color: darkslategrey;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</body>

</html>