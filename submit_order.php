<?php
// 1. Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "laundry_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Capture data from the form
$name = $_POST['customer_name'];
$phone = $_POST['phone_number'];
$service = $_POST['service_type'];
$qty = $_POST['quantity'];
// This says: Use the form value, but if it's missing, just call it 'Not Specified'
$pay_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "Not Specified";

// 3. Pricing Logic (Naira)
$price_per_unit = ($service == "Wash & Iron") ? 500 : (($service == "Dry Clean") ? 2500 : 200);
$total_price = $qty * $price_per_unit;

// 4. Save to Database
$stmt = $conn->prepare("INSERT INTO orders (customer_name, phone_number, service_type, quantity, total_price, payment_method) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssids", $name, $phone, $service, $qty, $total_price, $pay_method);

// --- THIS IS THE SUCCESS SECTION START ---
if ($stmt->execute()) {
    
    // Change this to YOUR actual WhatsApp number
    $my_whatsapp = "2348012345678"; 
    
    // Create the message for WhatsApp
    $message = "Hello NaijaClean! 🇳🇬%0A"
             . "*New Order Received*%0A"
             . "--------------------------%0A"
             . "Name: $name%0A"
             . "Service: $service%0A"
             . "Qty: $qty items%0A"
             . "Total: ₦" . number_format($total_price, 2) . "%0A"
             . "Payment: $pay_method%0A"
             . "Phone: $phone";

    $wa_link = "https://wa.me/$my_whatsapp?text=$message";

    // This is what the customer sees on their screen
    echo "
    <div style='text-align:center; padding: 50px; font-family: sans-serif; border: 2px solid #008751; border-radius: 15px; max-width: 500px; margin: 50px auto;'>
        <h1 style='color: #008751;'>Order Received, Boss! ✅</h1>
        <p style='font-size: 1.2em;'>Your total bill is <strong>₦" . number_format($total_price, 2) . "</strong></p>
        
        <div style='background: #f9f9f9; padding: 15px; border-radius: 10px; margin: 20px 0;'>
            <p><strong>Next Step:</strong> Click the button below to send us your location on WhatsApp for pickup.</p>
        </div>

        <a href='$wa_link' target='_blank' style='display: inline-block; background: #25D366; color: white; padding: 18px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 18px;'>
            Send to WhatsApp 📱
        </a>
        
        <br><br>
        <a href='index.php' style='color: #666; text-decoration: none;'>← Back to Home</a>
    </div>";

} else {
    echo "Something went wrong: " . $stmt->error;
}
// --- THIS IS THE SUCCESS SECTION END ---

$stmt->close();
$conn->close();
?>