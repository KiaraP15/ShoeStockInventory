<?php
include 'add_shoe.php';

if (isset($_GET['id'])) {
    $shoe_id = $_GET['id'];
    $shoe = getShoeById($shoe_id);
    if (!$shoe) {
        echo "Shoe not found!";
        exit();
    }
} else {
    echo "Shoe ID not provided!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_shoe"])) {
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    updateShoe($shoe_id, $brand, $size, $color);
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
<style>
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            margin: 100px;
        }
        .logo-container img {
            height: 200px; 
        }
        .logo-container h1 {
            flex: 1;
            text-align: center;
            font-size: 2em;
        }
    </style>
    <div class="container">

        <div class="logo-container">
            <img src="r.png" alt="Left Logo">
        <h1>Edit Shoe</h1>
            <img src="r.png" alt="Right Logo">
         </div>
        <form action="edit.php?id=<?= $shoe['ShoeID'] ?>" method="post">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="<?= $shoe['Brand'] ?>" required><br>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" value="<?= $shoe['Size'] ?>" required><br>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?= $shoe['Color'] ?>" required><br>
            <br>
            <button class="button type1" type="submit" name="update_shoe">Update Shoe</button>
        </form>
        
        <!-- Back to Home Button -->
        <center><a href="index.php" class="button type2">Back</a></center>
    </div>
</body>
</html>