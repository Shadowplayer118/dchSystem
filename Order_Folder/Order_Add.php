<?php
include '../inventoryDb_connect.php';

$supplierId = $_GET['SupplierId'];
$inventoryId = $_GET['ItemId'];
$priceId = $_GET['priceId'];

$sql = "SELECT * FROM inventory2 WHERE inventory_Id = $inventoryId";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$brand = $row['brand'];
$category = $row['category'];
$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];

$sql2 = "SELECT * FROM supplier WHERE supplier_Id = $supplierId";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$supplierName = $row2['agent_firstname'] . ' ' . $row2['agent_middlename'] . ' ' . $row2['agent_lastname'];
$company = $row2['company_name'];

$sql3 = "SELECT * FROM price_list WHERE price_list_Id = $priceId";
$result3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$price = $row3['dealer_price'];
$price_id =  $row3['price_list_Id'];



if (isset($_POST['submit'])) {
    $date_ordered = $_POST['date'];
    $units = $_POST['units'];
    $placed_by = $_POST['placed_by'];
    $total_price = floatval($price) * intval($units);
    $status = "Pending";

    // $sql = "INSERT INTO orders (inventory_Id, supplier_Id, date_ordered, units, total_price,price_list_Id,placed_by,status) 
    //         VALUES ($inventoryId, $supplierId, $date_ordered, $units, $total_price,$price_id,$placed_by,$status)";
    $sql2 = "UPDATE inventory2 SET ordered = 'Pending' WHERE inventory_id = $inventoryId";
    
    $result = mysqli_query($con, $sql2);
   


    $sql = "INSERT INTO orders (inventory_Id, supplier_Id, date_ordered, units, total_price, price_list_Id, placed_by, status) 
    VALUES ($inventoryId, $supplierId, '$date_ordered', $units, $total_price, $price_id, '$placed_by', '$status')";
    
    $result = mysqli_query($con, $sql);
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
    <title>Add Order</title>
</head>

<body>

    <form method="post">
        <div class="container my-5">
            <h1>Place Order for:</h1>
            <h1><?php echo $brand . ' ' . $itemDesc_1 . ' ' . $itemDesc_2 . ' ' . $itemDesc_3; ?></h1>
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name="date" autocomplete="off" required> 
            </div>
            <div class="form-group">
                <label>Supplier</label>
                <input type="text" class="form-control" placeholder="Enter Supplier ID" name="supplier" autocomplete="off"
                    value="<?php echo $supplierName; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Company</label>
                <input type="text" class="form-control" placeholder="Enter Supplier ID" name="company" autocomplete="off"
                    value="<?php echo $company; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" placeholder="Enter Price" name="price" autocomplete="off"
                    value="<?php echo $price; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Units</label>
                <input type="text" class="form-control" placeholder="Enter number of units" name="units" autocomplete="off" required>
            </div>
            <br>

           

            <div class="form-group">
                <label>Ordered By</label>
                <input type="text" class="form-control" placeholder="Enter who placed this order" name="placed_by" autocomplete="off" required>
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
