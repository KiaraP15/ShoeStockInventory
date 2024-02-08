<?php
// Database connection
$host = 'localhost';
$dbname = 'your_database';
$username = 'your_username';
$password = 'your_password';

try {
    $conn = new PDO("mysql:host=$host;dbname=shoestock", "InfoSystem", "csab");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];

    // Function to add shoe to the database
    function addShoe($brand, $size, $color) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO shoes (brand, size, color) VALUES (?, ?, ?)");
        $stmt->execute([$brand, $size, $color]);
        return $conn->lastInsertId();
    }

    // Add shoe to database
    try {
        $shoe_id = addShoe($brand, $size, $color);
        echo "New shoe added successfully with ID: $shoe_id";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // Add buttons to go back to main page
    echo '<br>';
    echo '<a href="index.php"><button>Add More Stock</button></a>'; // Assuming index.php is your main page
}
?>
