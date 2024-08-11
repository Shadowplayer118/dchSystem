
<script>

var selectedRowId = null;

</script>


<?php
include '../inventoryDb_connect.php';

$filterValue = '';

// if (isset($_GET['filter'])) {
//     $filterValue = $_GET['filter'];
//     $sql = "SELECT * FROM orders WHERE brand LIKE '%$filterValue%' OR category LIKE '%$filterValue%' OR itemCode LIKE '%$filterValue%' OR itemNumber LIKE '%$filterValue%'";
// } else {
//     $sql = "SELECT * FROM orders";
// }

$sql = "SELECT  inventory2.inventory_Id,requisition.requisition_id,inventory2.itemDesc_1, inventory2.itemDesc_2, inventory2.itemDesc_3,inventory2.brand,requisition.units, requisition.status,requisition.prepared_by,requisition.received_by,requisition.date_requested
FROM requisition
INNER JOIN inventory2 ON requisition.inventory_Id = inventory2.inventory_Id;
";

$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
          <link rel="stylesheet" type="text/css" href="../uniStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <title>Manage Requests</title>

    
  
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
    <h1>Manage Requesitions</h1>
<button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
<a href="Requesiton_Place.php" class = "links";>Make Request</a>

<form method="GET">
    <label for="filter">Filter by Item brand:</label>
    <input type="text" id="filter" name="filter" value="<?= $filterValue ?>">
    <button type="submit">Filter</button>
</form> 




<div class="table-container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">item Id</th>
            <th scope="col">Item</th>
            <th scope="col">Brand</th>
            <th scope="col">Units</th>
      
            <th scope="col">Status</th>
            <th scope="col">Prepared By</th>
            <th scope="col">Recieved By</th>
            <th scope="col">Date Requested</th>
            <th scope="col">ACTIONS</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $requisition_id = $row['requisition_id'];
                $item_id = $row['inventory_Id'];
                $item_name = $row['itemDesc_1'] . ' ' . $row['itemDesc_2'] . ' ' . $row['itemDesc_3'];
                $brand = $row['brand'];
                $units = $row['units'];
               
                $status = $row['status'];
                $prepared_by = $row['prepared_by'];
                $recieved_by = $row['received_by'];
                $date_requested = $row['date_requested'];
                

                echo '
                <tr>
                    <th scope="col">' . $requisition_id . '</th>
                    <th scope="col">' . $item_id . '</th>
                    <th scope="col">' . $item_name . '</th>
                    <th scope="col">' . $brand . '</th>
                    <th scope="col">' . $units . '</th>
                  
                    <th scope="col">' . $status . '</th>
                    <th scope="col">' . $prepared_by . '</th>
                    <th scope="col">' . $recieved_by . '</th>
                    <th scope="col">' . $date_requested . '</th>
        
                    <td>
                       <a href="Requesition_Resolve.php?resolveId=' . $requisition_id. '" class = "links";>Resolve</a>
                     <a href="Requesition_Update.php?updateId=' . $requisition_id . '" target="_blank" class = "links";>Update</a>
                     <a href="Requesition_Delete.php?deleteId=' . $requisition_id . '" class = "links";>Delete</a>
                     <a href="Requesition_Note.php?ReqId=' . $requisition_id . '" target="_blank" class = "links faq";>?</a>
                    
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

    

</div>



</body>
</html>
