<?php
// 1. Database Connection include karen
include("../config/db.php");

$message = "";

// 2. Jab user Login button dabaye
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_with_string($conn, $_POST['email']);
    $password = mysqli_real_escape_with_string($conn, $_POST['password']);

    // Query check karen
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Login success! Aap yahan session start kar sakte hain ya dashboard par bhej sakte hain
        $message = "<div style='color: green;'>Login Successful! Welcome " . $user['username'] . "</div>";
        // Header("Location: ../index.php"); // Agar dashboard par bhejna ho
    } else {
        $message = "<div style='color: red;'>Invalid Email or Password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xenofin Login</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f4f4f9; }
        .login-container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; color: #333; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #5c67f2; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #4a54e1; }
        .message { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Xenofin Login</h2>
    
    <div class="message"><?php echo $message; ?></div>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    
    <p style="text-align: center; font-size: 0.8rem;">
        Default: shuban / shuban12
    </p>
</div>

</body>
</html>
