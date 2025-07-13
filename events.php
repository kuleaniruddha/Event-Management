<?php
// Establish connection to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, description FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - XIE</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0c3fc, #8ec5fc);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #5c258d;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }

        main {
            padding: 30px;
            max-width: 900px;
            margin: auto;
        }

        .event {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .event:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .event h2 {
            color: #5c258d;
            margin-bottom: 10px;
        }

        .event p {
            color: #333;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <header>
        <h1>Our Events</h1>
    </header>

    <main>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="event">';
                echo '<h2>' . htmlspecialchars($row['name']) . '</h2>';
                echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No events found.</p>';
        }
        $conn->close();
        ?>
    </main>
</body>
</html>
