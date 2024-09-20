<?php
// Include the database connection file
include 'db.php';

$conn = open_db();

$certificate = null;

// Handle search request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_number = $_POST['registration_number'];

    // Fetch the certificate from the database
    $sql = "SELECT * FROM birth_certificates WHERE registration_number = '$registration_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $certificate = $result->fetch_assoc();
    } else {
        echo "<div class='error'>No birth certificate found with this registration number.</div>";
    }
}
close_db($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        h2 {
            color: #4CAF50;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"], .logout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
        }

        input[type="submit"]:hover, .logout-btn:hover {
            background-color: #45a049;
        }

        .certificate-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .certificate-details p {
            margin: 10px 0;
            color: #555;
        }

        .error {
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }

        .logout-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>View Birth Certificate</h2>
    <form action="user_dashboard.php" method="post">
        <label for="registration_number">Registration Number:</label>
        <input type="text" name="registration_number" required><br>
        <input type="submit" value="View Certificate">
    </form>

    <?php if ($certificate): ?>
        <div class="certificate-details">
            <h3>Certificate Details</h3>
            <p><strong>Name:</strong> <?php echo $certificate['name']; ?></p>
            <p><strong>Birth Date:</strong> <?php echo $certificate['birth_date']; ?></p>
            <p><strong>Birth Place:</strong> <?php echo $certificate['birth_place']; ?></p>
            <p><strong>Father's Name:</strong> <?php echo $certificate['father_name']; ?></p>
            <p><strong>Mother's Name:</strong> <?php echo $certificate['mother_name']; ?></p>
            <p><strong>Registration Number:</strong> <?php echo $certificate['registration_number']; ?></p>
        </div>
    <?php endif; ?>

    <!-- Logout Button -->
    <div class="logout-container">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
