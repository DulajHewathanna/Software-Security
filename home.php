<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc); /* Blue gradient background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* Header styles */
        .header {
            background: rgba(255, 255, 255, 0.1); /* Transparent white background */
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Add shadow for more depth */
            color: #fff;
            max-width: 600px;
            width: 100%;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
            letter-spacing: 2px;
            font-weight: bold;
            background: linear-gradient(to right, #1e3c72, #2a5298); /* Dark blue gradient text */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; /* Text with gradient effect */
        }
        /* Button styles */
        .buttons {
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: #2196f3; /* Blue button */
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.2em;
            font-weight: bold;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Add shadow */
            transition: all 0.3s ease;
        }
        .button:hover {
            background-color: #1976d2; /* Darken button on hover */
            transform: translateY(-5px); /* Hover effect with button pop */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }
        /* Content styles */
        .content {
            text-align: center;
            color: white;
            margin-top: 20px;
            font-size: 1.2em;
        }
        /* Responsive design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }
            .button {
                padding: 10px 20px;
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <div class="header">
        <h1>Welcome to Birth Certificate System</h1>
        <div class="buttons">
            <!-- Links to other pages -->
            <a href="index.php" class="button">Login</a>
            <a href="info.php" class="button">Info</a>
        </div>
    </div>
    <!-- Content of the home page -->
    <div class="content">
        <p>
            This is the home page of the Birth Certificate System. Here, you can log in to access the services or view more information about the system.
        </p>
    </div>
</body>
</html>
