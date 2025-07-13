<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $winner_name = $_POST['winner_name'];
    $event_id = $_POST['event_id'];

    $sql = "INSERT INTO winners (event_id, winner_name) VALUES ('$event_id', '$winner_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Winner added successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Winner</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #0072ff;
            color: white;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005dd1;
        }

        .success {
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            width: 350px;
        }

        .error {
            text-align: center;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            width: 350px;
        }
    </style>
</head>
<body>
    <form action="add_winner.php" method="POST">
        <h1>Add Winner</h1>

        <label for="winner_name">Winner Name:</label>
        <input type="text" name="winner_name" required>

        <label for="event">Select Event:</label>
        <select name="event_id">
            <option value="1">Spandan</option>
            <option value="2">Transmission</option>
            <option value="3">Sparx</option>
        </select>

        <button type="submit">Add Winner</button>
    </form>
</body>
</html>
