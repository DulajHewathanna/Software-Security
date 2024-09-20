<?php

session_start();


include 'db.php'; 

$conn = open_db();


$error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        if (password_verify($password, $admin['password'])) {
            
            $_SESSION['admin_username'] = $username;
            header('Location: admin_dashboard.php');
            exit();
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Invalid username or password.';
    }

    
    $stmt->close();
    $conn->close();
}
close_db($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1d2b64, #f8cdda);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <!-- Display error message if any -->
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <!-- Login form -->
        <form method="POST" action="admin_login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
