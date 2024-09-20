<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2193b0, #6dd5ed); /* Gradient background */
            margin: 0;
            padding: 0;
            color: #333;
        }
        /* Header styles */
        .header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .header h1 {
            margin: 0;
        }
        /* Main content styles */
        .content {
            padding: 20px;
            max-width: 800px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .content h2 {
            text-align: center;
            margin-top: 0;
        }
        /* Button styles */
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <div class="header">
        <h1>About the Birth Certificate System</h1>
    </div>
    
    <!-- Main content section -->
    <div class="content">
        <h2>What is the Birth Certificate System?</h2>
        <p>
            The Birth Certificate System is an online platform designed to manage and store birth certificates. 
            It allows administrators to add and manage birth certificate records, while users can view their birth certificates securely.
        </p>
        <h2>Features</h2>
        <ul>
            <li>Admin can add, edit, and delete birth certificate records.</li>
            <li>Users can securely view their birth certificates.</li>
            <li>Authentication and authorization mechanisms ensure secure access to sensitive information.</li>
        </ul>
        <h2>How to Use</h2>
        <p>
            To use the system, administrators need to log in to the dashboard to manage certificates. 
            Users can log in to view their personal birth certificate details. 
            For any assistance, please contact the support team.
        </p>
        
        <!-- Back button to return to home -->
        <a href="home.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>
