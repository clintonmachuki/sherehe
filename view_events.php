<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Upcoming Events</h2>
        <div id="events-container">
            <?php include_once "fetch_events.php"; ?>
        </div>
    </div>
</body>
</html>
