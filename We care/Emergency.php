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
            background-image: url('22222.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 40%;
            margin: 8px auto;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        .btn {
            background-color: #7d7c7c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #bec7be;
        }

        .btn-back {
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .btn-back:hover {
            background-color: #555;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .success-message {
            display: none;
            color: darkslategrey;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>We are ready to help you.</h2>
        <form id="locationForm" action="" method="post">
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" placeholder="Enter location">
            </div>
            <div class="form-group">
                <label for="house-number">House Number:</label>
                <input type="text" id="house-number" name="house-number" placeholder="Enter house number">
            </div>
            <div class="form-group">
                <label for="street-name">Street Name:</label>
                <input type="text" id="street-name" name="street-name" placeholder="Enter street name">
            </div>
            <div class="form-group">
                <label for="building-type">Type of Building:</label>
                <select id="building-type" name="building-type">
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="hotel">Hotel</option>
                    <option value="residential-complex">Residential Complex</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description of Medical Condition:</label>
                <textarea id="description" name="description" rows="4" placeholder="Enter description"></textarea>
            </div>
            <div class="button-group">
                <input type="submit" class="btn" value="Submit">
                <a href="https://localhost/We%20care/" class="btn-back">Back to Home Page</a>
            </div>
        </form>
        <div class="success-message" id="successMessage">
            Request submitted successfully!
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const locationInput = document.getElementById('location');

            // Get user's current location using Geolocation API
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Use reverse geocoding to get the address from latitude and longitude
                    fetch(`https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`)
                        .then(response => response.json())
                        .then(data => {
                            const address = data.locality;
                            locationInput.value = address;
                        })
                        .catch(error => {
                            console.error('Error fetching location:', error);
                        });
                }, error => {
                    console.error('Error getting user location:', error);
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
            }

            // Handle form submission
            document.getElementById('locationForm').addEventListener('submit', function (event) {
                event.preventDefault();
                document.getElementById('successMessage').style.display = 'block';
            });
        });
    </script>
</body>

</html>