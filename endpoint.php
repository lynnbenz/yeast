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

    // Fetch all the rows as an associative array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Store the values in the respective arrays
        $dates[] = $row['date'];
        $locations[] = $row['location'];
        $lastValues[] = $row['lastValue'];
    }

    // Loop through the arrays and print the values
    //for ($i = 0; $i < count($dates); $i++) {
     //   echo "Date: " . $dates[$i] . ", Location: " . $locations[$i] . ", Last Value: " . $lastValues[$i] . "<br>";
   // }

    // Create an associative array to store the data
    $data = [
        'dates' => $dates,
        'locations' => $locations,
        'lastValues' => $lastValues
    ];

    // Convert the data array to JSON format
    $json = json_encode($data, JSON_NUMERIC_CHECK);

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