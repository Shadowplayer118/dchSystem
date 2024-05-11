<?php
include '../inventoryDb_connect.php';

$id = $_GET['ItemId'];

   
$sql = "select * from inventory2 where inventory_Id = $id";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
$inventory_Id = $row['inventory_Id'];
$itemNumber = $row['itemNumber'];
$itemCode = $row['itemCode'];
$brand = $row['brand'];
$category = $row['category'];
$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];
$price = $row['price'];

$totalstockValue = $row['totalstockValue'];



if (isset($_POST['submit'])) {
    $date_ordered = $_POST['date'];
    $units = $_POST['units'];
    $price = $_POST['total_price'];
    $prepared_by = $_POST['prepared_by'];
    $recieved_by = $_POST['recieved_by'];
    $note = $_POST['note'];
    $total_price = floatval($price) * intval($units);
    $status = "Pending";

    // $sql = "INSERT INTO orders (inventory_Id, supplier_Id, date_ordered, units, total_price,price_list_Id,placed_by,status) 
    //         VALUES ($inventoryId, $supplierId, $date_ordered, $units, $total_price,$price_id,$placed_by,$status)";

    $sql4 = "UPDATE inventory2 SET requested = 'Pending' WHERE inventory_id = $id";
    
    $result = mysqli_query($con, $sql4);

    $sql2 = "INSERT INTO requisition (note,inventory_Id, units, date_requested, total_price, prepared_by, received_by, status) 
    VALUES ('$note','$inventory_Id', '$units', '$date_ordered', '$total_price', '$prepared_by', '$recieved_by', '$status')";

    
    $result = mysqli_query($con, $sql2);
    if ($result) {
        echo "<script>alert('Data inserted successfully!');</script>";
        echo "<script>window.close();</script>";
        exit();
    } else {
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
    <title>Add Request</title>
</head>

<body>

    <form method="post">
        <div class="container my-5">
            <h1>Place Request for:</h1>
            <h1><?php echo $brand . ' ' . $itemDesc_1 . ' ' . $itemDesc_2 . ' ' . $itemDesc_3; ?></h1>
            <div class="form-group">
                <label>Date Requested</label>
                <input type="date" class="form-control" name="date" autocomplete="off" required>
            </div>
          
           
            <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" placeholder="Enter Price" name="total_price" autocomplete="off"
                    value="<?php echo $price; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Units</label>
                <input type="text" class="form-control" placeholder="Enter number of units" name="units" autocomplete="off" required>
            </div>
            <br>
            
           

            <div class="form-group">
                <label>Prepared By</label>
                <input type="text" class="form-control" placeholder="Enter who placed this order" name="prepared_by" autocomplete="off" required>
            </div>
            <br>

            <div class="form-group">
                <label>Recieved By</label>
                <input type="text" class="form-control" placeholder="Enter who placed this order" name="recieved_by" autocomplete="off" required>
            </div>
            <br>

            <div class="form-group">
                <label>Note</label>
                <input type="text" class="form-control" placeholder="Enter who placed this order" name="note" autocomplete="off">
            </div>
            <br>



            <button name="submit" class="btn btn-primary">Add</button>
            <button name="cancel" class="btn btn-danger" onclick="closeTab()">Cancel</button>
        </div>
    </form>

    <script>
        function closeTab() {
            window.close();
        }
    </script>

</body>

</
