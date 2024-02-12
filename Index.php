<?php
include 'add_shoe.php'; // Include the CRUD operations file

// Check if form is submitted for adding a new shoe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_shoe"])) {
    // Retrieve form data
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    // Add shoe to database using the addShoe() function
    $shoe_id = addShoe($brand, $size, $color);
    echo "New shoe added successfully with ID: $shoe_id";
}

// Check if form is submitted for deleting a shoe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_shoe"])) {
    // Retrieve shoe ID to delete
    $shoe_id = $_POST["shoe_id"];
    // Delete shoe from database using the deleteShoe() function
    deleteShoe($shoe_id);
    echo "Shoe deleted successfully";
}

// Check if form is submitted for updating a shoe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_shoe"])) {
    // Retrieve form data
    $shoe_id = $_POST["shoe_id"];
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    // Update shoe information in the database using the updateShoe() function
    updateShoe($shoe_id, $brand, $size, $color);
    echo "Shoe information updated successfully";
}

// Check if form is submitted for editing a shoe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_shoe"])) {
    // Retrieve shoe ID to edit
    $shoe_id = $_POST["shoe_id"];
    // Redirect to edit page with shoe ID as parameter
    header("Location: edit.php?id=$shoe_id");
    exit();
}

$shoes = getShoes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Stock System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Shoe Stock System</h1>
        <h2>Add New Shoe</h2>
        <form action="index.php" method="post">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required><br>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required><br>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required><br>
            <button class="button type1" type="submit" name="add_shoe">Add Shoe</button>
        </form>

        <h2>Shoe Inventory</h2>
        <table id="inventoryTable">
            <thead>
                <tr>
                    <th>ShoeID</th>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($shoes as $shoe) { ?>
                    <tr>
                        <td><?= $shoe['ShoeID'] ?></td>
                        <td><?= $shoe['Brand'] ?></td>
                        <td><?= $shoe['Size'] ?></td>
                        <td><?= $shoe['Color'] ?></td>
                        <td>
                            <form action="index.php" method="post">
                                <input type="hidden" name="shoe_id" value="<?= $shoe['ShoeID'] ?>">
                                <input type="hidden" name="brand" value="<?= $shoe['Brand'] ?>">
                                <input type="hidden" name="size" value="<?= $shoe['Size'] ?>">
                                <input type="hidden" name="color" value="<?= $shoe['Color'] ?>">
                                <button class="button edit-button" type="submit" name="edit_shoe">Edit</button>
                                <button class="button delete-button" type="submit" name="delete_shoe">Delete</button>
                                <button class="button update-button" type="submit" name="update_shoe">Update</button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
