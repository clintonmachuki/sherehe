<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
    <nav>
    <ul>
        <li><a href="admin_dashboard.php">Dashboard</a></li>
        <li><a href="#">Manage Users</a></li>
        <li><a href="#">Settings</a></li>
        <li><a href="post_event.php">Post Events</a></li>
        <li><a href="view_events.php">View Events</a></li> <!-- New menu item -->
        <li><a href="admin_logout.php">Logout</a></li>
    </ul>
    </nav>

        <div class="container">
            <?php
            echo "<h2>Welcome, " . htmlspecialchars($_SESSION['admin_email']) . "!</h2>";
            ?>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Manage Users</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="admin_logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h3>Admin Dashboard Content</h3>
        <p>This is the admin dashboard page where you can manage users and settings.</p>
        <div>
            <?php
            echo "<p><strong>Email:</strong> " . htmlspecialchars($_SESSION['admin_email']) . "</p>";
            ?>
        </div>
    </div>
</body>
</html>
