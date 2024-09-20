<?php
// Include the database connection file
include 'db.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); // Redirect to login page if not logged in
    exit();
}

$certificate = null; // To store certificate details
$error_message = ''; // To store error messages

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registration_number = $_POST['registration_number'];

    // Fetch the certificate from the database
    $sql = "SELECT * FROM birth_certificates WHERE registration_number = '$registration_number'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $certificate = $result->fetch_assoc();
    } else {
        $error_message = "No birth certificate found with this registration number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Birth Certificate</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>View Birth Certificate</h2>
    <form action="view_certificate.php" method="post">
        <label for="registration_number">Registration Number:</label>
        <input type="text" name="registration_number" required><br>
        <input type="submit" value="View Certificate">
    </form>

    <?php if ($certificate): ?>
        <h3>Certificate Details</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($certificate['name']); ?></p>
        <p><strong>Birth Date:</strong> <?php echo htmlspecialchars($certificate['birth_date']); ?></p>
        <p><strong>Birth Place:</strong> <?php echo htmlspecialchars($certificate['birth_place']); ?></p>
        <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($certificate['father_name']); ?></p>
        <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($certificate['mother_name']); ?></p>
        <p><strong>Registration Number:</strong> <?php echo htmlspecialchars($certificate['registration_number']); ?></p>
        
        <?php if (!empty($certificate['certificate_image'])): ?>
            <h3>Certificate Image</h3>
            <img src="<?php echo htmlspecialchars('uploads/' .$certificate['certificate_image']); ?>" alt="Certificate Image" style="max-width: 100%; height: auto;">
        <?php else: ?>
            <p>No certificate image available.</p>
        <?php endif; ?>

    <?php elseif ($error_message): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <p><a href="user_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
