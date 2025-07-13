<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db = "event_management";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Secure login using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=? AND role=?");
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        if ($row['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid username, password, or role.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - XIE Event Management</title>
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

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        select {
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
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #5a67d8;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="center-form">
        <div>
            <h1>Login</h1>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form method="POST">
                <label>Username:</label>
                <input type="text" name="username" required>

                <label>Password:</label>
                <input type="password" name="password" required>

                <label>Login as:</label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit">Login</button>
            </form>
        </div>
        <p>Don't have an account? <a href="create_account.php">Create one</a></p>

    </div>
</body>
</html>
