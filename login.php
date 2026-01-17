<?php
session_start();
// If already logged in, go straight to admin
if(isset($_SESSION['admin_logged_in'])) { header("Location: admin.php"); exit; }

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "admin"; // You can change this
    $password = "laundry123"; // You can change this to something stronger!

    if ($_POST['user'] == $username && $_POST['pass'] == $password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid Username or Password, Boss!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - NaijaClean</title>
    <style>
        body { font-family: sans-serif; background: #008751; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); width: 300px; }
        h2 { text-align: center; color: #333; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #008751; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .error { color: red; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔒 Admin Login</h2>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="user" placeholder="Username" required>
            <input type="password" name="pass" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>