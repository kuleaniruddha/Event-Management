<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT registrations.name, registrations.email, events.name AS event_name
        FROM registrations
        JOIN events ON registrations.event_id = events.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Registrations</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }
        nav {
            text-align: center;
            margin: 20px 0;
        }
        nav a {
            margin: 0 15px;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            margin: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Registered Participants</h1>
        <nav>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="add_winner.php">Add Winner</a>
            <a href="winners.php">View Winners</a>
            <a href="view_registrations.php">View Registrations</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Event</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['event_name']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
