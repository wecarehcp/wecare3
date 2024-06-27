<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "wecare");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search query
$searchQuery = "";

// If a search query is submitted
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

// If form is submitted to add a patient
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_patient'])) {
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

    // Insert patient
    $sql = "INSERT INTO patients (patient_name, patient_id, phone, reserve_number, nationality, dob, age, gender, blood_type, chronic_diseases, current_medications, allergies, previous_surgeries, vaccinations, family_diseases) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssisissssss", $patient_name, $patient_id, $phone, $reserve_number, $nationality, $dob, $age, $gender, $blood_type, $chronic_diseases, $current_medications, $allergies, $previous_surgeries, $vaccinations, $family_diseases);

    if ($stmt->execute() === TRUE) {
        echo "Patient added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch products
$sql = "SELECT id, name, description, price, image FROM products1";
if ($searchQuery != "") {
    $sql .= " WHERE name LIKE ? OR description LIKE ?";
}
$stmt = $conn->prepare($sql);
if ($searchQuery != "") {
    $likeSearchQuery = "%" . $searchQuery . "%";
    $stmt->bind_param("ss", $likeSearchQuery, $likeSearchQuery);
}
$stmt->execute();
$result = $stmt->get_result();

// Check if query was successful
if ($result === false) {
    die("Error executing query: " . $stmt->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>We Care</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
    }
    header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #7b7b7b;
      color: #fff;
      padding: 5px 20px;
    }
    .left-menu nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
    }
    .left-menu nav ul li {
      margin-right: 20px;
    }
    .left-menu nav ul li a {
      text-decoration: none;
      color: #fff;
    }
    .logo img {
      height: 70px;
    }
    .search-container {
      display: flex;
      align-items: center;
    }
    .search-container input {
      padding: 5px;
      margin-right: 5px;
    }
    .main-container {
      display: flex;
      justify-content: space-between;
      padding: 20px;
    }
    .form-container, .product-container {
      flex: 1;
      margin-right: 20px;
    }
    .product-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .product {
      width: 300px;
      margin: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      text-align: center;
    }
    .product img {
      width: 100%;
      border-radius: 8px;
    }
    .product h2 {
      margin-top: 10px;
      margin-bottom: 5px;
    }
    .product p {
      margin-bottom: 10px;
    }
    .product p.price {
      color: #4CAF50;
      font-size: 18px;
      margin-bottom: 10px;
    }
    .product button {
      margin-top: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .product button:hover {
      background-color: #4e79a7;
    }
    .cart-container {
      position: absolute;
      right: 0;
      top: 100px;
      width: 300px;
      background: #f1f1f1;
      border-left: 1px solid #ccc;
      height: calc(100% - 100px);
      overflow-y: auto;
      padding: 20px;
    }
    .cart-container h2 {
      text-align: center;
    }
    .cart-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }
    .cart-item span {
      flex: 1;
    }
    .cart-item button {
      margin-left: 10px;
    }
    .total-price {
      font-weight: bold;
      text-align: center;
      margin-top: 20px;
    }
    .delivery-value {
      text-align: center;
      margin-top: 10px;
      font-style: italic;
    }
    hr {
      border: 1px solid #ccc;
      margin: 20px 0;
    }
    .form-group {
      margin-bottom: 20px;
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
      border: 1px solid #333;
      border-radius: 3px;
      box-sizing: border-box;
    }
    .btn-checkout {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: white;
      border: none;
      cursor: pointer;
      text-align: center;
      font-size: 16px;
      margin-top: 20px;
    }
    .btn-checkout:hover {
      background-color: #4e79a7;
    }
    button[type="submit"] {
      background-color: #9c9ea0;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 3px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <header>
    <div class="left-menu">
      <nav>
        <ul>
          <li><a href="https://localhost/We%20care/">Home Page</a></li>
          <li><a href="https://localhost/We%20care/emergency.php">Emergency</a></li>
          <li><a href="https://localhost/We%20care/Appointment.php">Appointment</a></li>
          <li><a href="https://localhost/We%20care/About%20You.php">About you</a></li>
        </ul>
      </nav>
    </div>
    <div class="logo">
      <img src="We3.png" alt="We Care Logo">
    </div>
    <div class="search-container">
      <form method="GET" action="">
        <input type="text" id="searchInput" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
    </div>
  </header>
    <div class="product-container" id="productContainer">
      <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "'>";
                echo "<h2>" . $row["name"] . "</h2>";
                echo "<p>" . $row["description"] . "</p>";
                echo "<p class='price'>" . $row["price"] . " RO</p>";
                echo "<button onclick=\"addToCart(" . $row["id"] . ", '" . $row["name"] . "', " . $row["price"] . ")\">Add to Cart</button>";
                echo "</div>";
            }
        } else {
            echo "No results found";
        }
      ?>
    </div>
  </div>

  <div class="cart-container" id="cartContainer">
    <h2>Cart</h2>
  </div>

  <script>
    let cart = [];
    const deliveryValue = 2.00;

    function addToCart(id, name, price) {
      const existingProductIndex = cart.findIndex(item => item.id === id);
      if (existingProductIndex > -1) {
        cart[existingProductIndex].quantity += 1;
      } else {
        const product = { id, name, price, quantity: 1 };
        cart.push(product);
      }
      displayCart();
    }

    function updateQuantity(id, change) {
      const productIndex = cart.findIndex(item => item.id === id);
      if (productIndex > -1) {
        cart[productIndex].quantity += change;
        if (cart[productIndex].quantity <= 0) {
          cart.splice(productIndex, 1);
        }
      }
      displayCart();
    }

    function displayCart() {
      const cartContainer = document.getElementById('cartContainer');
      cartContainer.innerHTML = '';

      let totalPrice = 0;

      cart.forEach(item => {
        totalPrice += item.price * item.quantity;
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';
        cartItem.innerHTML = `
          <span>${item.name}</span>
          <span>${item.price.toFixed(2)} RO x ${item.quantity}</span>
          <div>
            <button onclick="updateQuantity(${item.id}, 1)">+</button>
            <button onclick="updateQuantity(${item.id}, -1)">-</button>
          </div>
        `;
        cartContainer.appendChild(cartItem);
      });

      const separator = document.createElement('hr');
      cartContainer.appendChild(separator);

      totalPrice += deliveryValue;

      const totalPriceElement = document.createElement('div');
      totalPriceElement.className = 'total-price';
      totalPriceElement.innerText = `Total: ${totalPrice.toFixed(2)} RO`;
      cartContainer.appendChild(totalPriceElement);

      const deliveryValueElement = document.createElement('div');
      deliveryValueElement.className = 'delivery-value';
      deliveryValueElement.innerText = `Including delivery: ${deliveryValue.toFixed(2)} RO`;
      cartContainer.appendChild(deliveryValueElement);

      const checkoutButton = document.createElement('button');
      checkoutButton.className = 'btn-checkout';
      checkoutButton.innerText = 'Checkout';
      checkoutButton.onclick = function() {
          window.location.href = 'checkout.php';
      };
      cartContainer.appendChild(checkoutButton);
    }
  </script>
</body>
</html>