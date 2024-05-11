<?php
include '../inventoryDb_connect.php';
$id = $_GET['updateId'];


$sql = "SELECT * 
FROM price_list 
INNER JOIN inventory2 ON price_list.inventory_Id = inventory2.inventory_Id
INNER JOIN supplier ON price_list.supplier_Id = supplier.supplier_Id WHERE price_list_id = $id;
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
    }
    }


if(isset($_POST['submit'])){
  
    $price = $_POST['price'];

    $totalstockValue = floatval($price) * intval($units);

    $sql = "UPDATE price_list SET dealer_price = $price where price_list_Id  = $id";
          
    $result = mysqli_query($con, $sql);
    if($result){
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.close();</script>";
        exit();
    } else{
        echo 'Error inserting data: ' . mysqli_error($con);
    }
}

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
 
    <title>Update Dealer Price</title>
</head>


<body>


<form method = "post">
<div class = "container my-5">
<h1>Update Dealer Price</h1>
<div class="form-group">
   <h2><?php echo $itemName?></h2>
   <h3><?php echo $brand?></h3>
   <h4><?php echo $supplierName?></h4>




    <div class="form-group">
    <label>Dealer Price</label>
    <input type="text" class="form-control"  placeholder="Enter item units" name="price" autocomplete = "off"
    value = <?php echo $dealer_price;?>>

   
  
  <br>
  <button name="submit" class="btn btn-primary">Update</button>
  <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>


<script>
function closeTab() {
    window.close();
}
</script>


</form>



</div>
  



 


    
</body>
</html>

