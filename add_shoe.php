<?php
// Database connection
$host = 'localhost';
$dbname = 'shoestock';
$username = 'InfoSystem';
$password = 'csab';

try {
    $conn = new PDO("mysql:host=$host;dbname=shoestock", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


// CREATE (Insert)
function addShoe($brand, $size, $color) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Shoes (Brand, Size, Color) VALUES (?, ?, ?)");
    $stmt->execute([$brand, $size, $color]);
    return $conn->lastInsertId();
}

// READ (Select)
function getShoes() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Shoes");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// READ (Select) a shoe by its ID
function getShoeById($shoe_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Shoes WHERE ShoeID = ?");
    $stmt->execute([$shoe_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// UPDATE
function updateShoe($shoe_id, $brand, $size, $color) {
    global $conn;
    $stmt = $conn->prepare("UPDATE Shoes SET Brand=?, Size=?, Color=? WHERE ShoeID=?");
    $stmt->execute([$brand, $size, $color, $shoe_id]);
}

// DELETE
function deleteShoe($shoe_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Shoes WHERE ShoeID=?");
    $stmt->execute([$shoe_id]);
}
?>
