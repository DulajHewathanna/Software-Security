<?php

include 'db.php';


session_start();


define('PEPPER', 'staticPepperValue123!@#'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $conn = open_db();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
        // Password must contain at least one uppercase letter, one lowercase letter, one number, one symbol, and be at least 8 characters long
        $error_message = "Password must contain at least one uppercase letter, one lowercase letter, one number, one symbol, and be at least 8 characters long.";
    } else {
        // Check if the username already exists
        $username = $conn->real_escape_string($username);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error_message = "Username already taken.";
        } else {
            // Generate a random salt
            $salt = bin2hex(random_bytes(16)); // 16-byte salt

            // Combine password with salt and pepper
            $password_with_salt_and_pepper = $salt . $password . PEPPER;

            // Hash the salted and peppered password
            $hashed_password = password_hash($password_with_salt_and_pepper, PASSWORD_DEFAULT);

            // Store the username, hashed password, and salt in the database
            $sql = "INSERT INTO users (username, password, salt, role) VALUES ('$username', '$hashed_password', '$salt', 'user')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to login page
                header('Location: index.php');
                exit();
            } else {
                $error_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Close the database connection
    close_db($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        form input[type="text"],
        form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="submit"]:hover {
            background-color: #218838;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        /* Add some animations */
        .container {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        <!-- Display error message if any -->
        <?php if (isset($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" name="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br>

            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" name="confirm_password" required><br>

            <input type="submit" value="Register">
        </form>

        <p><a href="index.php">Back to Login</a></p>
    </div>
</body>
</html>
