<?php
include 'add_shoe.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_shoe"])) {
    $brand = $_POST["brand"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $shoe_id = addShoe($brand, $size, $color);
    $message = "New shoe added successfully with ID: $shoe_id";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_shoe"])) {
    $shoe_id = $_POST["shoe_id"];
    deleteShoe($shoe_id);
    $message = "Shoe deleted successfully";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_shoe"])) {
    $shoe_id = $_POST["shoe_id"];
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
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
    </style>01
<body>
    <div class="container">
        <div class="logo-container">
            <img src="r.png" alt="Left Logo">
        <h1>Shoe Inventory System</h1>
            <img src="r.png" alt="Right Logo">
         </div>
        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form action="index.php" method="post">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required><br>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required><br>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required><br>
            <br>
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
                <?php foreach ($shoes as $shoe): ?>
                    <tr>
                        <td><?= $shoe['ShoeID'] ?></td>
                        <td><?= $shoe['Brand'] ?></td>
                        <td><?= $shoe['Size'] ?></td>
                        <td><?= $shoe['Color'] ?></td>
                        <td>
                            <form action="index.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="shoe_id" value="<?= $shoe['ShoeID'] ?>">
                                <button class="button edit-button" type="submit" name="edit_shoe">Edit</button>
                            </form>
                            <form action="index.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="shoe_id" value="<?= $shoe['ShoeID'] ?>">
                                <button class="button delete-button" type="submit" name="delete_shoe">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Shoe Inventory Overview</h2>
        <canvas id="inventoryChart"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable();

            var ctx = document.getElementById('inventoryChart').getContext('2d');
            var inventoryData = {
                labels: <?php echo json_encode(array_column($shoes, 'Brand')); ?>,
                datasets: [{
                    label: 'Shoe Sizes',
                    data: <?php echo json_encode(array_column($shoes, 'Size')); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            var inventoryChart = new Chart(ctx, {
                type: 'bar',
                data: inventoryData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>