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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
 
    <title>Supplier Select</title>
</head>


<body>



  <!-- Modal -->
 
    <h1>Select a Supplier to insert with items</h1>
    <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>


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
                
                  <button><a href="Pricelist_Supplier_Add.php?SupplierId='.$supplier_Id.'" target = "_blank" class = "links";>Select</a></button>
               
                
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
    
    
</body>
</html>