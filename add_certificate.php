<?php

include 'db.php';


session_start();




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $birth_place = $_POST['birth_place'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $registration_number = $_POST['registration_number'];

    
    $target_dir = "uploads/";  
    $target_file = $target_dir . basename($_FILES["certificate_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    
    $check = getimagesize($_FILES["certificate_image"]["tmp_name"]);
    if ($check === false) {
        echo "<div class='error'>File is not an image.</div>";
        $uploadOk = 0;
    }

    
    if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo "<div class='error'>Only JPG and JPEG files are allowed.</div>";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "<div class='error'>Sorry, your file was not uploaded.</div>";
    } else {
        
        if (is_dir($target_dir) && is_writable($target_dir)) {
            if (move_uploaded_file($_FILES["certificate_image"]["tmp_name"], $target_file)) {
                
                $sql = "INSERT INTO birth_certificates (name, birth_date, birth_place, father_name, mother_name, registration_number, certificate_image) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

                
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssss", $name, $birth_date, $birth_place, $father_name, $mother_name, $registration_number, $target_file);

                if ($stmt->execute()) {
                    echo "<div class='success'>New birth certificate added successfully!</div>";
                } else {
                    echo "<div class='error'>Error: " . $stmt->error . "</div>";
                }

                
                $stmt->close();
            } else {
                echo "<div class='error'>Sorry, there was an error uploading your file.</div>";
            }
        } else {
            echo "<div class='error'>The upload directory does not exist or is not writable.</div>";
        }
    }

    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Birth Certificate</title>
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
            max-width: 500px;
            width: 100%;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-weight: bold;
            margin: 10px 0;
        }

        .success {
            color: green;
            font-weight: bold;
            margin: 10px 0;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Add Birth Certificate</h2>
    <form action="add_certificate.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" required><br>

        <label for="birth_place">Birth Place:</label>
        <input type="text" name="birth_place" required><br>

        <label for="father_name">Father's Name:</label>
        <input type="text" name="father_name" required><br>

        <label for="mother_name">Mother's Name:</label>
        <input type="text" name="mother_name" required><br>

        <label for="registration_number">Registration Number:</label>
        <input type="text" name="registration_number" required><br>

        <label for="certificate_image">Upload Certificate Image (JPG/JPEG):</label>
        <input type="file" name="certificate_image" accept=".jpg, .jpeg" required><br>

        <input type="submit" value="Add Certificate">
    </form>

    <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
