<?php
$servername = "localhost";
$username = "clinton";
$password = "clinton";
$dbname = "shereh_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
