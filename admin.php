<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Database Admin Panel</h2>

    <h3>Create Database</h3>
    <form action="admin.php" method="POST">
        <label for="dbname">Database Name:</label>
        <input type="text" id="dbname" name="dbname" required>
        <button type="submit" name="create_db">Create Database</button>
    </form>

    <h3>Create Table</h3>
    <form action="admin.php" method="POST">
        <label for="tablename">Table Name:</label>
        <input type="text" id="tablename" name="tablename" required>
        <label for="fields">Fields (e.g., field1 VARCHAR(255), field2 INT):</label>
        <input type="text" id="fields" name="fields" required>
        <button type="submit" name="create_table">Create Table</button>
    </form>

    <?php
    // Database Connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);

    // Create Database
    if (isset($_POST['create_db'])) {
        $dbname = $_POST['dbname'];
        $sql = "CREATE DATABASE $dbname";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Database $dbname created successfully.</p>";
        } else {
            echo "<p>Error creating database: " . $conn->error . "</p>";
        }
    }

    // Create Table
    if (isset($_POST['create_table'])) {
        $tablename = $_POST['tablename'];
        $fields = $_POST['fields'];
        $sql = "CREATE TABLE $tablename ($fields)";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Table $tablename created successfully.</p>";
        } else {
            echo "<p>Error creating table: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
