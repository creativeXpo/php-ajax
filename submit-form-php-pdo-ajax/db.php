<?php 

try {
    // Establish a new PDO connection
    $con = new PDO("mysql:host=localhost;dbname=php-ajax", "root", "");
    
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Display error message if connection fails
    echo "Connection failed: " . $e->getMessage();
}
