<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $artists = mysqli_real_escape_string($conn, $_POST['artists']);
    
    // Handle file uploads for multiple images
    $image_filenames = [];
    if (!empty($_FILES['event_image']['name'][0])) {
        $total_files = count($_FILES['event_image']['name']);
        for ($i = 0; $i < $total_files; $i++) {
            $temp_file = $_FILES['event_image']['tmp_name'][$i];
            $target_file = "uploads/" . uniqid() . "_" . $_FILES['event_image']['name'][$i];
            if (move_uploaded_file($temp_file, $target_file)) {
                $image_filenames[] = $target_file;
            }
        }
    }

    // Add additional fields as needed
    // Insert event details into the database
    $query = "INSERT INTO events (title, description, date, time, artists, image) VALUES ('$event_title', '$event_description', '$event_date', '$event_time', '$artists', '" . implode(',', $image_filenames) . "')";
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
