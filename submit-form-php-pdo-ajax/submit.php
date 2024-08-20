<?php 

// Sleep for 3 seconds to simulate delay (for testing purposes)
sleep(3);

include('db.php');

// Get POST data and sanitize it
$name = trim($_POST['name']);
$city = trim($_POST['city']);
$marks = trim($_POST['marks']);

try {
    // Prepare SQL statement with placeholders
    $sql = 'INSERT INTO studenttwo (name, city, marks) VALUES (:name, :city, :marks)';
    
    // Prepare statement
    $stmt = $con->prepare($sql);
    
    // Bind parameters to the statement
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':marks', $marks);

    // Execute the statement
    if($stmt->execute()) {
        echo "Data Submitted.";
    } else {
        echo "Error submitting data.";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

