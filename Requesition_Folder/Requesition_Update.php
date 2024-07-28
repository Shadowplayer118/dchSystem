<?php
include '../inventoryDb_connect.php';
$id = $_GET['updateId'];

$sql = "SELECT  inventory2.inventory_Id,requisition.requisition_id,inventory2.itemDesc_1, inventory2.itemDesc_2, inventory2.itemDesc_3,inventory2.brand,requisition.units, requisition.status,requisition.note,requisition.prepared_by,requisition.received_by,requisition.date_requested
FROM requisition
INNER JOIN inventory2 ON requisition.inventory_Id = inventory2.inventory_Id
where requisition_id = $id";


$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];
$itemName = $itemDesc_1.' '.$itemDesc_2.' '.$itemDesc_3;
$brand = $row['brand'];
$units = $row['units'];
$note = $row['note'];

$status = $row['status'];
$received_by = $row['received_by'];
$prepared_by = $row['prepared_by'];
$date_requested = $row['date_requested'];


if (isset($_POST['submit'])) {
    $newUnits = $_POST['units'];
    $received_by = $_POST['received_by'];
    $prepared_by = $_POST['prepared_by'];
    $date_requested = $_POST['date_requested'];
    $note = $_POST['note'];

    $sql = "UPDATE requisition SET units = $newUnits, received_by = '$received_by', prepared_by = '$prepared_by', date_requested = '$date_requested', note = '$note' WHERE requisition_id = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.close();</script>";
        exit();
    } else {
        echo 'Error updating data: ' . mysqli_error($con);
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


<div class="form-group">
    <label>Units</label>
    <input type="text" class="form-control"  placeholder="Enter new units" name="units" autocomplete = "off"
    value = <?php echo $units;?>>

    
    <div class="form-group">
    <label>Placed By</label>
    <input type="text" class="form-control"  placeholder="Enter item item code" name="received_by" autocomplete = "off"
    value = <?php echo $received_by;?>>

    <div class="form-group">
    <label>Placed By</label>
    <input type="text" class="form-control"  placeholder="Enter item item code" name="prepared_by" autocomplete = "off"
    value = <?php echo $prepared_by;?>>

    <div class="form-group">
    <label>Date Ordered</label>
    <input type="date" class="form-control"  placeholder="Enter item brand" name="date_requested" autocomplete = "off"
    value = <?php echo $date_requested;?>>

    <div class="form-group">
    <label>Note</label>
    <input type="text" class="form-control"  placeholder="Enter note" name="note" autocomplete = "off"
    value = <?php echo $note;?>>


  
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

