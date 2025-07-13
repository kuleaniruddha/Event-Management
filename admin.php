<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT registrations.id, registrations.name, registrations.email, events.name AS event_name 
        FROM registrations 
        JOIN events ON registrations.event_id = events.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - XIE Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registered Participants</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Event</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['event_name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
