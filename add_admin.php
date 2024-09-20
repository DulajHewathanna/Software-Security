<?php

include 'db.php';


$username = 'admin';
$password = 'admin'; 


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "INSERT INTO admins (username, password) VALUES ('$username', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "New admin added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
