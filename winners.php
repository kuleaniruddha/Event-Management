<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT winners.winner_name, events.name AS event_name 
        FROM winners 
        JOIN events ON winners.event_id = events.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Winners</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        table {
            margin: 0 auto;
            width: 60%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #6a0572;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ffe0f0;
        }
    </style>
</head>
<body>
    <h1>Winners List</h1>
    <table>
        <tr>
            <th>Event</th>
            <th>Winner</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['event_name']; ?></td>
            <td><?php echo $row['winner_name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
