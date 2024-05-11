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
          <link rel="stylesheet" type="text/css" href="OrderDesign.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <title>Place Table</title>
    <h2>DCH Inventory </h2>
    
    <div class="header">
 

    <div class="link-container">
    <a href="../HomePage.php"  class="index-link">Home</a>
    <br>
    </div>

<div class="link-container">
    <a href="../Inventory_Folder/inventoryTable.php"  class="index-link">Inventory</a>
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

<h1>Place Orders</h1>

<button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
<a href="Order_Manager.php" class = "links";>Manage Orders</a>

<!-- <a href="inventoryAdd.php"  target = "_blank">Add Inventory</a> -->

<form method="GET">
    <label for="filter">Filter by Item Code:</label>
    <input type="text" id="filter" name="filter">
    <button type="submit">Filter</button>
</form>

<div class="table-class">
<table>
    <div class="table table-hover table-sm">
        <table class="table">
          <thead>
            <tr>
       
            <th scope="col">Price List ID</th>
              <th scope="col">Item ID</th>
              <th scope="col">Item</th>
              <th scope="col">brand</th>
              <th scope="col">Supplier ID</th>
              <th scope="col">Supplier Name</th>
              <th scope="col">Comapny</th>
              <th scope="col">Dealer Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <?php




// $sql = "SELECT purchase.purchase_Id,purchase.date,purchase.supplier,purchase.price,
// purchase.units,purchase.totalstockValue, 

// inventory.inventory_Id,inventory.itemNumber,inventory.itemCode


// FROM purchase inner join inventory on purchase.inventory_Id =inventory.inventory_Id";


// $sql = "SELECT * FROM price_list";




$sql = "SELECT * 
FROM price_list 
INNER JOIN inventory2 ON price_list.inventory_Id = inventory2.inventory_Id
INNER JOIN supplier ON price_list.supplier_Id = supplier.supplier_Id Order by inventory2.inventory_Id;
";






$result = mysqli_query($con, $sql);
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {
  
    $price_list_Id = $row['price_list_Id'];
    $company_name = $row['company_name'];//FK
    $brand = $row['brand'];//FK
    $dealer_price = $row['dealer_price'];
    $itemName = $row['itemDesc_1'] . ' ' . $row['itemDesc_2'] . ' ' . $row['itemDesc_3'];
    $supplierName = $row['agent_firstname'] . ' ' . $row['agent_middlename'] . ' ' . $row['agent_lastname'];
    $inventory_Id = $row['inventory_Id'];
    $supplier_Id = $row['supplier_Id'];
    $company_name = $row['company_name'];
   

  echo'
  <tr>
  <th scope="col">'.$price_list_Id.'</th>            
  <th scope="col">'.$inventory_Id.'</th>
              <th scope="col">'.$itemName.'</th>
              <th scope="col">'.$brand.'</th>
              <th scope="col">'.$supplier_Id.'</th>
              <th scope="col">'.$supplierName.'</th>
              <th scope="col">'.$company_name.'</th>
              <th scope="col">'.$dealer_price.'</th>
              
              <td>
           <a href="Order_Add.php?ItemId='.$inventory_Id.'&SupplierId='.$supplier_Id.'&priceId='.$price_list_Id.'" target = "_blank" class = "links";>Place Order</a>
         
            
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
  <!-- Modal -->
 
  
    
</body>
</html>