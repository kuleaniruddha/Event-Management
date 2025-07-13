<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(to right, #fddb92, #d1fdff);
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            margin-top: 15px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            background-color: #444;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #666;
        }

        main {
            padding: 40px;
            text-align: center;
        }

        main h2 {
            color: #333;
        }

        main p {
            font-size: 18px;
            color: #444;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <nav>
            <a href="index.html">Home</a>
            <a href="add_winner.php">Add Winner</a>
            <a href="winners.php">View Winners</a>
            <a href="view_registrations.php">View Registrations</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <h2>Admin Dashboard</h2>
        <p>Use the navigation links above to manage winners, view registrations, and logout.</p>
    </main>
</body>
</html>
