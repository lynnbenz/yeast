<?php

// Include the config.php file to get the connection string
require_once 'config.php';

try {
    // Create a new PDO instance using the connection string from config.php
    $pdo = new PDO($dsn, $username, $password, $options);

    // Set the error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query to select the desired columns from the table
    $query = "SELECT date, location, lastValue FROM air_quality";

    // Execute the query
    $stmt = $pdo->query($query);

    // Initialize the arrays
    $dates = [];
    $locations = [];
    $lastValues = [];

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
   

    // Convert the data array to JSON format
    $json = json_encode($rows, JSON_NUMERIC_CHECK);

    // Set the Content-Type header to application/json
    header('Content-Type: application/json');

    // Output the JSON data
    echo $json;

    

    // Close the database connection
    $pdo = null;
} catch (PDOException $e) {
    // Handle any errors that occurred during the database connection or query execution
    echo "Error: " . $e->getMessage();
}