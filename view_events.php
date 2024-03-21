<?php
include_once "db_connection.php";

// Query to fetch events ordered by upcoming dates
$query = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_filenames = explode(',', $row['image']);
        echo "<a href='event.php?id=" . htmlspecialchars($row['id']) . "' class='event-link'>";
        echo "<div class='event'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<img src='" . htmlspecialchars($image_filenames[0]) . "' alt='Event Image' class='event-image'>";
        echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
        echo "<p><strong>Time:</strong> " . htmlspecialchars($row['time']) . "</p>";
        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
        echo "</div>";
        echo "</a>";
    }
} else {
    echo "<p>No upcoming events found.</p>";
}

mysqli_close($conn);
?>
