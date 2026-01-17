<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }

$conn = new mysqli("localhost", "root", "", "laundry_db");

// --- SEARCH LOGIC ---
$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM orders WHERE customer_name LIKE '%$search%' OR phone_number LIKE '%$search%' ORDER BY order_date DESC";
} else {
    $sql = "SELECT * FROM orders ORDER BY order_date DESC";
}

$result = $conn->query($sql);
// --- LOGIC TO UPDATE STATUS ---
if (isset($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $new_status = $_GET['status'];
    $conn->query("UPDATE orders SET status='$new_status' WHERE id=$id");
    header("Location: admin.php"); 
}

// --- LOGIC TO DELETE ORDER ---
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM orders WHERE id=$id");
    header("Location: admin.php"); 
}

$result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaijaClean Admin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #008751; border-bottom: 3px solid #008751; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #008751; color: white; }
        
        /* Badges */
        .badge { padding: 5px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .Pending { background: #fff3cd; color: #856404; }
        .Washing { background: #d1ecf1; color: #0c5460; }
        .Ready { background: #d4edda; color: #155724; }
        
        /* Buttons */
        .btn { text-decoration: none; font-size: 11px; padding: 6px 10px; border-radius: 3px; color: white; margin-right: 5px; }
        .btn-wash { background: #17a2b8; }
        .btn-ready { background: #28a745; }
        .btn-delete { background: #dc3545; } /* Red for delete */
        .btn-wa { background: #25D366; }
    </style>
</head>
<body>

<div class="container">
    <a href="logout.php" style="float: right; color: red; text-decoration: none; font-weight: bold;">Logout 🚪</a>
    <h2>📋 Laundry Management Dashboard</h2>

    <div style="margin-bottom: 20px; background: #e9ecef; padding: 15px; border-radius: 8px;">
    <form method="GET" action="admin.php" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Search by name or phone..." 
               value="<?php echo htmlspecialchars($search); ?>" 
               style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
        <button type="submit" style="background: #008751; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Search</button>
        <?php if($search != ""): ?>
            <a href="admin.php" style="padding: 10px; color: #666; text-decoration: none;">Clear</a>
        <?php endif; ?>
    </form>
</div>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): 
                $wa_msg = "Hello " . $row['customer_name'] . ", your laundry order is READY! 🧺";
                $wa_link = "https://wa.me/" . $row['phone_number'] . "?text=" . urlencode($wa_msg);
            ?>
            <tr>
                <td>
                    <strong><?php echo $row['customer_name']; ?></strong><br>
                    <small><?php echo $row['phone_number']; ?></small>
                </td>
                <td>₦<?php echo number_format($row['total_price'], 2); ?></td>
                <td><?php echo $row['payment_method']; ?></td>
                <td><span class="badge <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
                
                <td>
                    <a href="admin.php?update_id=<?php echo $row['id']; ?>&status=Washing" class="btn btn-wash">Wash</a>
                    <a href="admin.php?update_id=<?php echo $row['id']; ?>&status=Ready" class="btn btn-ready">Ready</a>
                </td>
                
                <td>
                    <?php if($row['status'] == 'Ready'): ?>
                        <a href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-wa">Notify 💬</a>
                    <?php endif; ?>
                    
                    <a href="admin.php?delete_id=<?php echo $row['id']; ?>" 
                       class="btn btn-delete" 
                       onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>