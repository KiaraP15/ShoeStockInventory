<?php
include 'db.php';

function addShoe($brand, $size, $color) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Shoes (Brand, Size, Color) VALUES (?, ?, ?)");
    $stmt->execute([$brand, $size, $color]);
    return $conn->lastInsertId();
}

function getShoes() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Shoes");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getShoeById($shoe_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Shoes WHERE ShoeID = ?");
    $stmt->execute([$shoe_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateShoe($shoe_id, $brand, $size, $color) {
    global $conn;
    $stmt = $conn->prepare("UPDATE Shoes SET Brand=?, Size=?, Color=? WHERE ShoeID=?");
    $stmt->execute([$brand, $size, $color, $shoe_id]);
}

function deleteShoe($shoe_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Shoes WHERE ShoeID=?");
    $stmt->execute([$shoe_id]);
}
?>