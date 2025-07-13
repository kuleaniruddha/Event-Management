<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Default role is 'user'
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'user')");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $error = "Username already exists or registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account - XIE Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-form {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #667eea;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        p {
            text-align: center;
        }

        a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="center-form">
        <h1>Create Account</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
