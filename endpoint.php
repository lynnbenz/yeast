<?php

echo 'Hello World!';

// Include the config.php file to get the connection string
require_once '/path/to/config.php';

try {
    // Create a new PDO instance using the connection string from config.php
    $pdo = new PDO($connectionString);

    // Set the error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query to select the desired columns from the table
    $query = "SELECT date, location, lastValue FROM air_quality";

    // Execute the query
    $stmt = $pdo->query($query);

    // Fetch all the rows as an associative array
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Loop through the rows and print the values of the selected columns
    foreach ($rows as $row) {
        echo "Date: " . $row['date'] . ", Location: " . $row['location'] . ", Last Value: " . $row['lastValue'] . "<br>";
    }
} catch (PDOException $e) {
    // Handle any errors that occurred during the database connection or query execution
    echo "Error: " . $e->getMessage();
}