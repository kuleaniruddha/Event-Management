<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

// Connect to DB
$conn = new mysqli("localhost", "root", "", "event_management");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$username = $_SESSION['username'];

// Fetch upcoming events
$sql_upcoming_events = "SELECT events.name, events.event_date 
                        FROM events 
                        WHERE events.event_date >= CURDATE()";
$stmt_upcoming = $conn->prepare($sql_upcoming_events);
$stmt_upcoming->execute();
$result_upcoming = $stmt_upcoming->get_result();

// Fetch winners of upcoming events
$sql_winners = "SELECT events.name AS event_name, winners.winner_name 
                FROM winners 
                JOIN events ON winners.event_id = events.id 
                WHERE events.event_date >= CURDATE()";
$stmt_winners = $conn->prepare($sql_winners);
$stmt_winners->execute();
$result_winners = $stmt_winners->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
        }
        .dashboard {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 12px;
            width: 80%;
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        h2 {
            font-size: 2.2em;
            text-align: center;
            margin-bottom: 30px;
            color: #fffbfb;
        }
        h3 {
            font-size: 1.8em;
            margin-bottom: 20px;
            text-align: center;
            color: #ffd700;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background-color: #fff;
            color: #333;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        li:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .logout {
            display: block;
            text-align: center;
            margin-top: 30px;
        }
        .logout a {
            background-color: #d9534f;
            color: #fff;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }
        .logout a:hover {
            background-color: #c9302c;
        }
        .empty-message {
            text-align: center;
            font-size: 1.2em;
            color: #fffbfb;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h2>
        
        <h3>Upcoming Events:</h3>
        <?php
        if ($result_upcoming->num_rows > 0) {
            echo "<ul>";
            while($row = $result_upcoming->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['name']) . " <strong>(Date: " . $row['event_date'] . ")</strong></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='empty-message'>No upcoming events.</p>";
        }
        ?>

        <h3>Winners of Upcoming Events:</h3>
        <?php
        if ($result_winners->num_rows > 0) {
            echo "<ul>";
            while($row = $result_winners->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['event_name']) . " - <strong>Winners: " . htmlspecialchars($row['winner_name']) . "</strong></li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='empty-message'>No winners for upcoming events.</p>";
        }
        ?>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
