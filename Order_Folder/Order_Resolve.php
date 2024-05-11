<?php
include '../inventoryDb_connect.php';
$id = $_GET['resolveId'];

$sql = "SELECT inventory2.price,inventory2.inventory_Id,orders.order_id,inventory2.itemDesc_1,inventory2.itemDesc_2,inventory2.itemDesc_3,inventory2.brand,
supplier.agent_firstname,supplier.agent_middlename,supplier.agent_lastname,price_list.dealer_price,orders.units,orders.total_price,orders.status, orders.placed_by,orders.date_ordered FROM orders 
INNER JOIN price_list ON orders.price_list_Id = price_list.price_list_Id
INNER JOIN inventory2 ON price_list.inventory_Id = inventory2.inventory_Id
INNER JOIN supplier ON price_list.supplier_Id = supplier.supplier_Id where order_id = $id";


$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];
$itemName = $itemDesc_1.' '.$itemDesc_2.' '.$itemDesc_3;
$brand = $row['brand'];
$supplier_name = $row['agent_firstname'] . ' ' . $row['agent_middlename'] . ' ' . $row['agent_lastname'];
$dealer_price = $row['dealer_price'];
$units = $row['units'];
$totalstockValue = $row['total_price'];
$status = $row['status'];
$placed_by = $row['placed_by'];
$date_ordered = $row['date_ordered'];
$price = $row['price'];

$inventory_Id  = $row['inventory_Id'];


$sql2 = "SELECT * FROM inventory2 where inventory_Id = $inventory_Id";
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_assoc($result2);
$old_Units  = $row2['units'];

if(isset($_POST['submit'])){
    $newUnits = $_POST['units'];
    
    $NewPlacedby = $_POST['placed_by'];
    $NewDateOrdered = $_POST['date_ordered'];
    $NewTotal = intval($newUnits) + intval($old_Units);
    $NewVal =  intval($newUnits) * floatval($price);
  


    $sql = "UPDATE inventory2 SET units = $NewTotal, ordered = 'None', totalstockValue = $NewVal where inventory_id  = $inventory_Id";
   
   
          
    $result = mysqli_query($con, $sql);
    if($result){
        $sqldel = "DELETE FROM orders where order_id  = $id";
        mysqli_query($con,$sqldel);
        header('location:Order_Manager.php');
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
 
    <title>Resolve Order</title>
</head>


<body>


<form method = "post">
<div class = "container my-5">
<h1>Are you sure you want to resolve this order?</h1>

<div>Item Name: <?php echo $itemName ?></div>
<div>Item Brand: <?php echo  $brand ?></div>
<div>Supplier: <?php echo $supplier_name ?></div>



<div class="form-group">
    <label>Units</label>
    <input type="text" class="form-control"  placeholder="Enter new units" name="units" autocomplete = "off"
    value = <?php echo $units;?>>

    <div class="form-group">
    <label>Dealer Price</label>
    <input type="text" class="form-control"  placeholder="Enter item category" name="dealer_price" autocomplete = "off"
    value = <?php echo $dealer_price;?>>


    <div class="form-group">
    <label>Placed By</label>
    <input type="text" class="form-control"  placeholder="Enter item item code" name="placed_by" autocomplete = "off"
    value = <?php echo $placed_by;?>>

    <div class="form-group">
    <label>Date Ordered</label>
    <input type="text" class="form-control"  placeholder="Enter item brand" name="date_ordered" autocomplete = "off"
    value = <?php echo $date_ordered;?>>


  
  <br>
  <button name="submit" class="btn btn-primary">Yes</button>
 
  <button name="cancel" class="btn btn-danger"> <a href="Order_Manager.php">No</a></button>


<script>
function closeTab() {
    window.close();
}
</script>


</form>



</div>
  



 


    
</body>
</html>

