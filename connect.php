<?php
try {
    // Create a new PDO instance to connect to the database where the host is the localhost and the database name from phpmyadmin is assignment
    $pdo = new PDO('mysql:host=localhost;dbname=assignment', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
