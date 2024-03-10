<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: admin_login.html");
    exit();
}
include_once "db_connection.php"; // Include database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Tables</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_email']); ?>!</h2>
            <nav>
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="#">Manage Users</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="view_tables.php">View Tables</a></li>
                    <li><a href="admin_logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h3>View Tables</h3>
        <?php
        // Get all table names from the database
        $query = "SHOW TABLES";
        $result = mysqli_query($conn, $query);
        
        // Display tables and their contents
        while ($row = mysqli_fetch_array($result)) {
            $table_name = $row[0];
            echo "<h4>$table_name</h4>";
            
            // Retrieve and display table contents
            $query_data = "SELECT * FROM $table_name";
            $data_result = mysqli_query($conn, $query_data);
            if ($data_result && mysqli_num_rows($data_result) > 0) {
                $num_fields = mysqli_num_fields($data_result);
                echo "<table border='1'>";
                echo "<tr><th>ID</th>";
                for ($i = 0; $i < $num_fields; $i++) {
                    $field_info = mysqli_fetch_field_direct($data_result, $i);
                    echo "<th>" . htmlspecialchars($field_info->name) . "</th>";
                }
                echo "</tr>";
                while ($data_row = mysqli_fetch_assoc($data_result)) {
                    echo "<tr>";
                    echo "<td>" . $data_row['id'] . "</td>";
                    foreach ($data_row as $key => $value) {
                        echo "<td contenteditable='true'>" . htmlspecialchars($value) . "</td>"; // Make content editable
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data available in $table_name table.</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
