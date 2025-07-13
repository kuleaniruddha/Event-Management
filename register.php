<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $event_id = (int)$_POST['event_id']; // cast to integer

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO registrations (name, email, event_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $event_id); // 's' for string, 'i' for integer

    if ($stmt->execute()) {
        // Registration successful, redirect to thank you page
        header("Location: thankyou.php");
        exit(); // Make sure to stop further script execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
