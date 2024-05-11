<?php
include '../inventoryDb_connect.php';

$filterValue = '';

if (isset($_GET['filter'])) {
    $filterValue = $_GET['filter'];
    $sql = "SELECT * FROM inventory2 WHERE brand LIKE '%$filterValue%' OR category LIKE '%$filterValue%' OR itemCode LIKE '%$filterValue%' OR itemNumber LIKE '%$filterValue%'";
} else {
    $sql = "SELECT * FROM inventory2 ORDER BY inventory_Id DESC";
}

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <title>Inventory Select</title>
</head>

<body>

<h1>Select an Item to insert with suppliers</h1>

<form method="GET">
    <label for="filter">Filter by Item brand:</label>
    <input type="text" id="filter" name="filter" value="<?= $filterValue ?>">
    <button type="submit">Filter</button>
</form>
<button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>


<div class="table-container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ITEM CODE</th>
            <th scope="col">IMAGE</th>
            <th scope="col">BRAND</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">ITEM DESCRIPTION</th>
            <th scope="col">PRICE</th>
        
      
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $inventory_Id = $row['inventory_Id'];
                $itemNumber = $row['itemNumber'];
                $itemCode = $row['itemCode'];
                $image = $row['image'];
                $brand = $row['brand'];
                $category = $row['category'];
                $itemDesc_1 = $row['itemDesc_1'];
                $itemDesc_2 = $row['itemDesc_2'];
                $itemDesc_3 = $row['itemDesc_3'];
                $price = $row['price'];
                $units = $row['units'];
                $totalstockValue = $row['totalstockValue'];
                $requested = $row['requested'];
                $ordered = $row['ordered'];
                $active = $row['active'];

                echo '
                <tr>
                    <th scope="col">' . $itemNumber . '</th>
                    <th scope="col">' . $itemCode . '</th>
                    <th scope="col">' . $image . '</th>
                    <th scope="col">' . $brand . '</th>
                    <th scope="col">' . $category . '</th>
                    <th scope="col">' . $itemDesc_1 . " " . $itemDesc_2 . " " . $itemDesc_3 . '</th>
                    <th scope="col">' . $price . '</th>
      
                    <td>
                        <button><a href="Pricelist_Inventory_Add.php?ItemId=' . $inventory_Id . '" target="_blank">Select</a></button>
                    
                    </td>
                </tr>
                ';
            }
        }
        ?>
        </tbody>
    </table>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="main.js"></script>


<script>
        function closeTab() {
            window.close();
        }
    </script>

<script>
        function confirmRedirect() {
            return confirm("Are you sure you want to Delete this data?");
        }
    </script>
    
</body>
</html>
