<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    
    // Add additional fields as needed

    // Example query to insert event into database
    $query = "INSERT INTO events (title, description, date, time) VALUES ('$event_title', '$event_description', '$event_date', '$event_time')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Event posted successfully, redirect to confirmation page or back to dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Error occurred while posting event
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect back to post event form if accessed directly without submitting
    header("Location: post_event.html");
    exit();
}

mysqli_close($conn);
?>
