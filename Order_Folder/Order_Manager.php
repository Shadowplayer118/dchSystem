<?php
include '../inventoryDb_connect.php';

$filterValue = '';

$sql = "SELECT inventory2.inventory_Id, orders.order_id,inventory2.itemDesc_1,inventory2.itemDesc_2,inventory2.itemDesc_3,inventory2.brand,
supplier.agent_firstname,supplier.agent_middlename,supplier.agent_lastname,price_list.dealer_price,orders.units,orders.total_price,orders.status, orders.placed_by,orders.date_ordered FROM orders 
INNER JOIN price_list ON orders.price_list_Id = price_list.price_list_Id
INNER JOIN inventory2 ON price_list.inventory_Id = inventory2.inventory_Id
INNER JOIN supplier ON price_list.supplier_Id = supplier.supplier_Id;";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/> -->
          <link rel="stylesheet" type="text/css" href="../uniStyle.css">
          <link rel="stylesheet" type="text/css" href="OrderDesign.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script> -->

    <title>Manage Orders</title>

  
</head>

<body>

<h2>DCH Inventory </h2>
<a href="../Activity/activity_table.php" target="_blank" class="activity-today">Activity</a>

<div class="header">


    

    <div class="link-container">
    <a href="../HomePage.php"  class="index-link">Home</a>
    <br>
    </div>
    <div class="link-container">
<a href="../Inventory_Folder_Warehouse/inventoryTable.php"  class="index-link">Store Inventory</a>
<br>

</div>

<div class="link-container">
<a href="../Inventory_Folder/inventoryTable.php"  class="index-link">Warehouse Inventory</a>
<br>

</div>
<div class="link-container">
<a href="../Order_Folder/Order_Manager.php" class="index-link">Manage Orders</a>
    <br>

</div>


    <div class="link-container">
    <a href="../Requesition_Folder/Requesiton_Manager.php"  class="index-link">Requesitions</a>
    <br>
    </div>

    <div class="link-container">
    <a href="../Supplier_Folder/Supplier_Table.php"  class="index-link">Suppliers</a>
    <br>
    </div>

    <div class="link-container">
    <a href="../PriceList_Folder/PriceList_Table.php"  class="index-link">Price List</a>
    <br>
    </div>

    
    <div class="link-container">
<a href="../logout.php" class="index-link">Log Out</a>
</div>
    

    </div>

    <div class="mainBody">
    <h1>Manage Orders</h1>
<button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
<a href="../Order_Folder/Order_Place.php" class = "links";>Make Order</a>

<form method="GET">
    <label for="filter">Filter by Item brand:</label>
    <input type="text" id="filter" name="filter" value="<?= $filterValue ?>">
    <button type="submit">Filter</button>
</form> 

 



<div class="table-container">
    <table class="table table-hover table-sm">
        <thead class="table-head">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">item Id</th>
            <th scope="col">Item</th>
            <th scope="col">Brand</th>
            <th scope="col">Supplier</th>
            <th scope="col">Dealer Price</th>
            <th scope="col">Units</th>
            <th scope="col">Total Price</th>
            <th scope="col">Status</th>
            <th scope="col">Placed By</th>
            <th scope="col">Date Ordered</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $order_id = $row['order_id'];
                $item_id = $row['inventory_Id'];
                $item_name = $row['itemDesc_1'] . ' ' . $row['itemDesc_2'] . ' ' . $row['itemDesc_3'];
                $brand = $row['brand'];
                $supplier_name = $row['agent_firstname'] . ' ' . $row['agent_middlename'] . ' ' . $row['agent_lastname'];
                $dealer_price = $row['dealer_price'];
                $units = $row['units'];
                $total_price = $row['total_price'];
                $status = $row['status'];
                $placed_by = $row['placed_by'];
                $date_ordered = $row['date_ordered'];
                

                echo '
                <tr>
                    <th scope="col">' . $order_id . '</th>
                    <th scope="col">' . $item_id . '</th>
                    <th scope="col">' . $item_name . '</th>
                    <th scope="col">' . $brand . '</th>
                    <th scope="col">' . $supplier_name . '</th>
                    <th scope="col">' . $dealer_price . '</th>
                    <th scope="col">' . $units . '</th>
                    <th scope="col">' . $total_price . '</th>
                    <th scope="col">' . $status . '</th>
                    <th scope="col">' . $placed_by . '</th>
                    <th scope="col">' . $date_ordered . '</th>
        
                    <td>
                   <a href="Order_Resolve.php?resolveId=' . $order_id . '" class = "links";>Resolve</a>
                 <a href="Order_Update.php?updateId=' . $order_id . '" target="_blank" class = "links";>Update</a>
                  <a href="Order_Delete.php?deleteId=' . $order_id . '" class = "links";>Delete</a>
                    </td>
                </tr>
                ';
            }
        }
        ?>
        </tbody>
    </table>
</div>


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
    

</body>
</html>
