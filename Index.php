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
            <form action="add_shoe.php" method="post">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required><br>
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required><br>
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required><br>
            <button class="button type1">
                </button>
        </form>

        <h2>Shoe Inventory</h2>
        <table id="inventoryTable">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sample inventory data
                $inventoryData = array(
                    array("brand" => "Nike", "size" => "10", "color" => "Black"),
                    array("brand" => "Adidas", "size" => "9", "color" => "White"),
                    array("brand" => "Puma", "size" => "8", "color" => "Blue")
                );

                // Populate the inventory table with sample data
                foreach ($inventoryData as $shoe) {
                    echo "<tr>";
                    echo "<td>" . $shoe["brand"] . "</td>";
                    echo "<td>" . $shoe["size"] . "</td>";
                    echo "<td>" . $shoe["color"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript code for adding a new row to the inventory table
        document.getElementById("addShoeForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission

            // Get form input values
            var brand = document.getElementById("brand").value;
            var size = document.getElementById("size").value;
            var color = document.getElementById("color").value;

            // Create a new row and populate it with form data
            var newRow = "<tr>";
            newRow += "<td>" + brand + "</td>";
            newRow += "<td>" + size + "</td>";
            newRow += "<td>" + color + "</td>";
            newRow += "</tr>";

            // Append the new row to the table body
            document.querySelector("#inventoryTable tbody").innerHTML += newRow;

            // Reset form inputs
            document.getElementById("brand").value = "";
            document.getElementById("size").value = "";
            document.getElementById("color").value = "";
        });
    </script>
</body>
</html>
