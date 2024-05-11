<?php
include '../inventoryDb_connect.php';
$id = $_GET['updateId'];

$sql = "SELECT orders.order_id,inventory2.itemDesc_1,inventory2.itemDesc_2,inventory2.itemDesc_3,inventory2.brand,
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


if(isset($_POST['submit'])){
    $newUnits = $_POST['units'];
  
    $NewPlacedby = $_POST['placed_by'];
    $NewDateOrdered = $_POST['date_ordered'];
    $NewTotal = intval($newUnits) * floatval($dealer_price);


    $sql = "UPDATE orders SET units = $newUnits, placed_by = '$NewPlacedby', date_ordered = '$NewDateOrdered', total_price = $NewTotal
     where order_id  = $id";
          
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
 
    <title>Update Order</title>
</head>


<body>


<form method = "post">
<div class = "container my-5">
<h1>Update Order</h1>

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

