<?php

function open_db() {
    $host = 'localhost'; 
    $dbname = 'birth_certificate_db'; 
    $username = 'root'; 
    $password = ''; 

    
    $conn = new mysqli($host, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $conn->set_charset('utf8');

    return $conn;
}


function escape_string($value, $conn) {
    return $conn->real_escape_string($value);
}


function is_admin($user_id, $conn) {
    $sql = "SELECT role FROM users WHERE id = " . escape_string($user_id, $conn);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['role'] == 'admin';
    }
    return false;
}


function close_db($conn) {
    $conn->close();
}
?>
