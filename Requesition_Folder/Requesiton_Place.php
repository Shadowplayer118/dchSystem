<?php
include '../inventoryDb_connect.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="../uniStyle.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <title>Request Table</title>

    <h2>DCH Inventory </h2>
    <a href="../Activity/activity_table.php" target="_blank" class="activity-today">Activity</a>

    <div class="header">
  
    <div class="link-container">
    <a href="../HomePage.php"  class="index-link">Home</a>
    <br>
    </div>
    <div class="link-container">
<a href="../Inventory_Folder_Warehouse/inventoryTable.php"  class="index-link">Warehouse Inventory</a>
<br>

</div>

<div class="link-container">
<a href="../Inventory_Folder/inventoryTable.php"  class="index-link">Store Inventory</a>
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
</head>


<body>

<div class="mainBody">

  <!-- Modal -->
 
  <h1>Make a Requestion</h1>
    <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
    <a href="Requesiton_Manager.php" class = "links";>Manage Requesitions</a>

    <!-- <a href="inventoryAdd.php"  target = "_blank">Add Inventory</a> -->

    <form method="GET">
        <label for="filter">Filter by Item Code:</label>
        <input type="text" id="filter" name="filter">
        <button type="submit">Filter</button>
    </form>

    <table>
        <div class="table-container">
            <table class="table">
              <thead>
                <tr>

                <th scope="col">Item Id</th>
                <th scope="col">Brand</th>
                  <th scope="col">Category</th>
                  <th scope="col">Price</th>
                  <th scope="col">Item Description</th>
                  <th scope="col">Available Units</th>
                  <th scope="col">Total Stock Value</th>
           
                </tr>
              </thead>
              <tbody id="tableBody">
                <?php




// $sql = "SELECT purchase.purchase_Id,purchase.date,purchase.supplier,purchase.price,
// purchase.units,purchase.totalstockValue, 

// inventory.inventory_Id,inventory.itemNumber,inventory.itemCode


// FROM purchase inner join inventory on purchase.inventory_Id =inventory.inventory_Id";


// $sql = "SELECT * FROM price_list";




$sql = "SELECT * FROM Inventory2 ORDER BY inventory_Id DESC";






$result = mysqli_query($con, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
    

        $brand = $row['brand'];
        $price = $row['price'];
        $itemName = $row['itemDesc_1'] . ' ' . $row['itemDesc_2'] . ' ' . $row['itemDesc_3'];
        $inventory_Id = $row['inventory_Id'];
        $units = $row['units'];
        $category = $row['category'];
        $totalstockValue = $row['totalstockValue'];

 
      echo'
      <tr>
             
      <th scope="col">'.$inventory_Id.'</th>
      <th scope="col">'.$brand.'</th>
                  <th scope="col">'.$category.'</th>
                
                  <th scope="col">'.$price.'</th>
           
                  <th scope="col">'.$itemName.'</th>  
                  <th scope="col">'.$units.'</th>
                  <th scope="col">'.$totalstockValue.'</th>
                  
                  <td>
                  <a href="Requesition_Add.php?ItemId='.$inventory_Id.'" target = "_blank" class = "links";>Place Request</a>
              
                  </td>
                </tr>
      ';
    }
}


?>


              </tbody>
            </table>
          </div>



    </table>

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
    

</div>



</body>
</html>