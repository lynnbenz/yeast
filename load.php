<?php

// include transform.php
include 'transform.php';

// require once config.php
require_once 'config.php';

//echo $air_quality;

try {
    // Erstellt eine neue PDO-Instanz mit der Konfiguration aus config.php
    $pdo = new PDO($dsn, $username, $password, $options);

    // SQL-Query mit Platzhaltern für das Einfügen von Daten
    $sql = "INSERT INTO air_quality (date, location, lastValue, unit, air_quality_color) VALUES (?, ?, ?, ?, ?)";

    // Bereitet die SQL-Anweisung vor
    $stmt = $pdo->prepare($sql);

    // Fügt jedes Element im Array in die Datenbank ein
    foreach ($air_quality as $item) {
        $stmt->execute([
            date('Y-m-d'),
            $item['location'],
            $item['lastValue'],
            $item['unit'],
            $item['air_quality_color'],
        ]);
    }

    echo "Daten erfolgreich eingefügt.";
} catch (PDOException $e) {
   die("Verbindung zur Datenbank konnte nicht hergestellt werden: " . $e->getMessage());
}