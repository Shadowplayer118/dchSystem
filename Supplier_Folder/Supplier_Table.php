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
 
    <title>Supplier Table</title>

    
   
</head>


<body>
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


    <div class="mainBody">

    <h1>Supplier Table</h1>
    <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
    <a href="Supplier_Add.php"  target = "_blank" class = "links";>Add New Supplier</a>

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
       
              
                  <th scope="col">Supplier Id</th>
                  <th scope="col">Image</th>
                  <th scope="col">Contact Details</th>
                  <th scope="col">Company Name</th>
                  <th scope="col">Agent Name</th>
                  <th scope="col">ACTIONS</th>
                </tr>
              </thead>
              <tbody id="tableBody">
                <?php




// $sql = "SELECT purchase.purchase_Id,purchase.date,purchase.supplier,purchase.price,
// purchase.units,purchase.totalstockValue, 

// inventory.inventory_Id,inventory.itemNumber,inventory.itemCode


// FROM purchase inner join inventory on purchase.inventory_Id =inventory.inventory_Id";


$sql = "SELECT * FROM supplier";






$result = mysqli_query($con, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $supplier_Id = $row['supplier_Id'];
        $contact_details = $row['contact_details'];
        $comapny_name = $row['company_name'];
        $agent_firstname = $row['agent_firstname'];
        $agent_middlename = $row['agent_middlename'];
        $agent_lastname = $row['agent_lastname'];
       

      echo'
      <tr>
                  <th scope="col">'.$supplier_Id.'</th>
                  <th scope="col">image</th>
                  <th scope="col">'.$contact_details.'</th>
                  <th scope="col">'.$comapny_name.'</th>
                  

                  <th scope="col">'. $agent_firstname.' '.substr($agent_middlename, 0, 1).'. '.$agent_lastname.'</th>

                  
                  <td>
                
                 <a href="Supplier_Update.php?supplierId='.$supplier_Id.'" target = "_blank" class = "links";>Edit</a>
          <a href="Supplier_Delete.php?supplierId='.$supplier_Id.'" class = "links";>Delete</a>
                
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
  <!-- Modal -->
 
   
</body>
</html>