<?php
session_start();
include_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Retrieve admin data from database
    $query = "SELECT * FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        // Set session variables for successful login
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_email'] = $admin['email'];

        // Redirect admin to dashboard page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        header("Location: admin_login.html?error=1");
        exit();
    }
} else {
    header("Location: admin_login.html");
    exit();
}

mysqli_close($conn);
?>
