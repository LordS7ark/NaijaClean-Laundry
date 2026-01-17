<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaijaClean | Professional Laundry Services</title>
    <style>
        :root { --ng-green: #008751; --ng-white: #ffffff; --light-gray: #f4f7f6; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; color: #333; background: var(--light-gray); }
        
        /* Navigation */
        nav { background: white; padding: 15px 10%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        nav .logo { font-size: 24px; font-weight: bold; color: var(--ng-green); }
        nav ul { list-style: none; display: flex; gap: 20px; margin: 0; }
        nav ul li a { text-decoration: none; color: #333; font-weight: 500; }

        /* Hero Section */
        .hero { background: linear-gradient(rgba(0,135,81,0.8), rgba(0,135,81,0.8)), url('https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?q=80&w=2070&auto=format&fit=crop'); 
                background-size: cover; background-position: center; height: 400px; display: flex; flex-direction: column; 
                justify-content: center; align-items: center; color: white; text-align: center; padding: 0 20px; }
        .hero h1 { font-size: 45px; margin-bottom: 10px; }

        /* Services Section */
        .services { padding: 50px 10%; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .service-card { background: white; padding: 20px; border-radius: 10px; text-align: center; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .service-card:hover { transform: translateY(-10px); }
        .service-card img { width: 60px; margin-bottom: 15px; }

        /* Form Section */
        .order-section { padding: 50px 10%; background: white; }
        .form-container { max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 30px; border-radius: 15px; }
        label { font-weight: bold; display: block; margin-top: 15px; }
        input, select { width: 100%; padding: 12px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { width: 100%; background: var(--ng-green); color: white; border: none; padding: 15px; margin-top: 20px; border-radius: 5px; font-size: 18px; cursor: pointer; }
        
        footer { background: #222; color: white; text-align: center; padding: 20px; margin-top: 50px; }
    </style>
</head>
<body>

<nav>
    <div class="logo">🇳🇬 NaijaClean</div>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#order">Order Now</a></li>
        <li><a href="login.php">Admin</a></li>
    </ul>
</nav>

<section class="hero">
    <h1>Fresh Clothes, Delivered.</h1>
    <p>The most reliable laundry service in Nigeria. We wash, you dress.</p>
    <a href="#order" style="background: white; color: var(--ng-green); padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px;">Book a Pickup</a>
</section>

<section class="services" id="services">
    <div class="service-card">
        <h3>Standard Wash</h3>
        <p>Perfect for your everyday wears, t-shirts and jeans.</p>
        <p><strong>₦500 / Item</strong></p>
    </div>
    <div class="service-card">
        <h3>Dry Cleaning</h3>
        <p>Special care for your Suits, Agbadas, and Senator wears.</p>
        <p><strong>₦2,500 / Item</strong></p>
    </div>
    <div class="service-card">
        <h3>Express Service</h3>
        <p>In a rush? Get your clothes back in less than 24 hours.</p>
        <p><strong>+50% Charge</strong></p>
    </div>
</section>

<section class="order-section" id="order">
    <div class="form-container">
        <h2 style="text-align: center; color: var(--ng-green);">Place Your Order</h2>
        <form action="submit_order.php" method="POST">
            <label>Full Name</label>
            <input type="text" name="customer_name" placeholder="e.g. Adebayo Chiroma" required>

            <label>WhatsApp Number</label>
            <input type="text" name="phone_number" placeholder="08012345678" required>

            <label>Service Type</label>
            <select name="service_type">
                <option value="Wash & Iron">Wash & Iron (₦500/shirt)</option>
                <option value="Dry Clean">Suit / Agbada (₦2,500/piece)</option>
                <option value="Ironing Only">Ironing Only (₦200/shirt)</option>
            </select>

            <label>Quantity of Items</label>
            <input type="number" name="quantity" min="1" value="1" required>

            <label>Payment Method</label>
            <select name="payment_method" required>
                <option value="Pay on Delivery">Cash/Transfer on Delivery</option>
                <option value="Online Payment">Pay Now (Online)</option>
            </select>

            <button type="submit" class="btn">Confirm Pickup Order</button>
        </form>
    </div>
</section>

<footer>
    <p>&copy; 2026 NaijaClean Laundry Services. All Rights Reserved.</p>
</footer>

</body>
</html>