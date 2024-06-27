<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wecare</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>We<span>Care</span></h1>
            </div>
            <div class="logo-image">
                <img src="we3.png" alt="Logo">
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="hero-text">
                <h2>Your health is our priority.</h2>
                <b><p>This website is dedicated to providing easy access to clinics and hospitals for patients.</p></b>
                <a href="https://localhost/We%20care/login.php" class="btn">login</a>
            </div>
            <div class="hero-image">
                <img src="www.png" alt="Doctor">
            </div>
        </section>
        <section class="services">
            <h2>Our Healthcare Service</h2>
            <div class="service-cards">
                <div class="card">
                    <h3>Emergency Department</h3>
                    <p><b>Requesting assistance in emergency situations and responding quickly.</b></p>
                </div>
                <div class="card">
                    <h3>Booking Appointment Department</h3>
                    <p><b>Ease of booking appointments in hospitals and clinics.</b></p>
                </div>
                <div class="card">
                    <h3>Pharmacy Department</h3>
                    <p><b>If you need some medicines or some care products.</b></p>
                </div>
                <div class="contact-info">
                <p><b>PhoneNumber:</b>+968 96793715 <b>Email:</b> Wecare@gmail.com</p>
            </div>
            </div>
        </section>
    </main>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f4f8;
            color: #333;
        }

        header {
            background-color: #7b7b7b;
            color: #fff;
            padding: 20px 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo h1 {
            font-size: 40px;
        }

        .logo span {
            color: #007bff;
        }

        .logo-image img {
            max-width: 100px; /* Adjust the size of the logo */
            height: auto;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 0;
            background-color: #ddd;
        }

        .hero-text h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero-text p {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7b7b7b;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }

        .services {
            text-align: center;
            padding: 40px 0;
        }

        .services h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .service-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            width: calc(33% - 40px); /* Make the cards rectangular and evenly spaced */
            margin: 10px;
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05); /* Add a slight zoom effect on hover */
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card p {
            font-size: 14px;
        }
    </style>
</body>
</html>
