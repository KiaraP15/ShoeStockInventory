<?php
include 'add_shoe.php'; // Include the CRUD operations file

// Check if shoe ID is provided in the URL
if(isset($_GET['id'])) {
    $shoe_id = $_GET['id'];
    // Retrieve shoe details from the database
    $shoe = getShoeById($shoe_id);
    if(!$shoe) {
        echo "Shoe not found!";
        exit();
    }
} else {
    echo "Shoe ID not provided!";
    exit();
}

// Check if form is submitted for updating the shoe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_shoe"])) {
    // Retrieve form data
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    // Update shoe information in the database using the updateShoe() function
    updateShoe($shoe_id, $brand, $size, $color);
    echo "Shoe information updated successfully";
    // Redirect back to index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shoe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Shoe</h1>
        <form action="edit.php?id=<?= $shoe_id ?>" method="post">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="<?= $shoe['Brand'] ?>" required><br>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" value="<?= $shoe['Size'] ?>" required><br>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?= $shoe['Color'] ?>" required><br>
            <button class="button" type="submit" name="update_shoe">Update Shoe</button>
        </form>
    </div>
</body>
</html>
