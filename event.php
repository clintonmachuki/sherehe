<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php
        // Check if event ID is provided in the URL
        if (isset($_GET['id'])) {
            $event_id = $_GET['id'];
            // Fetch event details from the database based on event ID
            include_once "db_connection.php";
            $query = "SELECT * FROM events WHERE id = $event_id";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $event = mysqli_fetch_assoc($result);
                // Display event details
                echo "<h2>" . htmlspecialchars($event['title']) . "</h2>";
                echo "<p><strong>Date:</strong> " . htmlspecialchars($event['date']) . "</p>";
                echo "<p><strong>Time:</strong> " . htmlspecialchars($event['time']) . "</p>";
                echo "<p>" . htmlspecialchars($event['description']) . "</p>";
            } else {
                echo "<p>Event not found.</p>";
            }
            mysqli_close($conn);
        } else {
            echo "<p>Event ID not provided.</p>";
        }
        ?>
    </div>
</body>
</html>
