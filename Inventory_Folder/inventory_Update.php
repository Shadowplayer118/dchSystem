<?php
    include '../inventoryDb_connect.php';

    $id = $_GET['updateId'];
    

    
    
    
    $sql = "SELECT * FROM inventory2 WHERE inventory_Id = $id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
        $Upimage = $row['image'];
        $Upinventory_Id = $row['inventory_Id'];
        $UpitemNumber = $row['itemNumber'];
        $UpitemCode = $row['itemCode'];
        $Upbrand = $row['brand'];
        $Upcategory = $row['category'];
        $UpitemDesc_1 = $row['itemDesc_1'];
        $UpitemDesc_2 = $row['itemDesc_2'];
        $UpitemDesc_3 = $row['itemDesc_3'];
        $Upprice = $row['price'];
        $Upunits = $row['units'];
        $Uplocation = $row['location'];
        $UptotalstockValue = $row['totalstockValue'];

    if (isset($_POST['submit'])) {
        $itemNumber = $_POST['itemNumber'];
        $itemCode = $_POST['itemCode'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $itemDesc_1 = $_POST['itemDesc_1'];
        $itemDesc_2 = $_POST['itemDesc_2'];
        $itemDesc_3 = $_POST['itemDesc_3'];
        $price = $_POST['price'];
        $units = $_POST['units'];
        $location = $_POST['location'];
        $totalstockValue = floatval($price) * intval($units);

    if ($_FILES['image']['size'] > 0) {
        $randomFilename = uniqid() . '-' . bin2hex(random_bytes(8));
        $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $finalFilename = $randomFilename . '.' . $fileExtension;
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $finalFilename);
    $Upimage = $finalFilename;
    }

   
    $UpitemCode = "'".$UpitemCode. "'";
    $Upbrand = "'".$Upbrand. "'";
    $Upcategory = "'".$Upcategory. "'";
    $UpitemDesc_1 = "'".$UpitemDesc_1. "'";
    $UpitemDesc_2 = "'".$UpitemDesc_2. "'";
    $UpitemDesc_3 = "'".$UpitemDesc_3. "'";
    $Uplocation = "'".$Uplocation. "'";

    $sql = "UPDATE inventory2 SET location = '$location',itemNumber = '$itemNumber', itemCode = '$itemCode', brand = '$brand', category = '$category', itemDesc_1 = '$itemDesc_1', itemDesc_2 = '$itemDesc_2', itemDesc_3 = '$itemDesc_3', price = '$price', units = '$units', totalstockValue = '$totalstockValue', image = '$Upimage' WHERE inventory_Id = $id;";
    $sqlCopy = "UPDATE inventory2 SET location = '$location',itemNumber = '$itemNumber', itemCode = '$itemCode', brand = '$brand', category = '$category', itemDesc_1 = '$itemDesc_1', itemDesc_2 = '$itemDesc_2', itemDesc_3 = '$itemDesc_3', price = '$price', units = '$units', totalstockValue = '$totalstockValue', image = '$Upimage' WHERE itemCode = $UpitemCode AND brand = $Upbrand AND category = $Upcategory AND itemDesc_1 = $UpitemDesc_1 AND itemDesc_2 = $UpitemDesc_2 AND itemDesc_3 = $UpitemDesc_3 AND location = $Uplocation;";
    
    $result = mysqli_query($con, $sql);
    if ($result) {
        
        $sql2 = "INSERT INTO activity(query, date_performed) VALUES ('" . mysqli_real_escape_string($con, $sqlCopy) . "', NOW())";

        if (mysqli_query($con, $sql2)) {
            echo "<script>alert('Data Updated');</script>";
            echo "<script>console.log(`" . addslashes($Upimage) . "`);</script>";
            // Optionally, close the window
            echo "<script>window.close();</script>";
            exit();
        } else {
            echo 'Error logging activity: ' . mysqli_error($con);
        }
    } 
    
    else {
        echo 'Error updating data: ' . mysqli_error($con);
    }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/> -->
    <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
    <link rel="stylesheet" type="text/css" href="../uniStyle.css">

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script> -->
    <title>Update Inventory</title>
    </head>


    <body>

        <div class="update-container">
            <form method="post" enctype="multipart/form-data">
                <h1>Update Inventory</h1>
                <div class="form-group">

                <label for="image">Select Image:</label>
                <img id="preview" src="../images/<?= $Upimage ?>" alt="Image Preview" style="display: block; max-width: 200px; max-height: 200px;">
                <br>
                <input type="file" id="image" name="image" onchange="previewImage(event)">
                <br>

                <script>
                    function previewImage(event) {
                    var input = event.target;
                    var preview = document.getElementById('preview');
                    preview.style.display = 'block';

                    var reader = new FileReader();
                    reader.onload = function() {
                    preview.src = reader.result;
                    };

                    if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                    } else {
                    preview.src = "../images/<?= $Upimage ?>";
                    
                    }
                    }
                </script>


                </div>

                <div class="edit-form">
                    <div class="fill-form  update_form">
                    <div class="form-group">
                    <label>Item Number</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item number" name="itemNumber"
                    autocomplete="off" value="<?= $UpitemNumber ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Code</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item item code" name="itemCode"
                    autocomplete="off" value="<?= $UpitemCode ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Brand</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item brand" name="brand"
                    autocomplete="off" value="<?= $Upbrand ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Category</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item category" name="category"
                    autocomplete="off" value="<?= $Upcategory ?>">
                    </div>

                    <div class="form-group">
                    <label>Description 1</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item description 1" name="itemDesc_1"
                    autocomplete="off" value="<?= $UpitemDesc_1 ?>">
                    </div>

                    <div class="form-group">
                    <label>Description 2</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item description 2" name="itemDesc_2"
                    autocomplete="off" value="<?= $UpitemDesc_2 ?>">
                    </div>

                    <div class="form-group">
                    <label>Description 3</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item description 3" name="itemDesc_3"
                    autocomplete="off" value="<?= $UpitemDesc_3 ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Price</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item price" name="price"
                    autocomplete="off" value="<?= $Upprice ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Units</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item units" name="units" id = "units"
                    autocomplete="off" value="<?= $Upunits ?>">
                    </div>

                    <div class="form-group">
                    <label>Item Location</label>
                    <br>
                    <input type="text" class="form-control" placeholder="Enter item Location" name="location"
                    autocomplete="off" value="<?= $Uplocation?>">
                    </div>
                    <br>

                    <button name="submit" class="btn btn-primary btn-update">Update</button>
                    
                    <a href="inventoryTable.php" class="btn btn-danger btn-cancel">Cancel</a>

                </div>

            </form>
        </div>
        
        <div class="Stockers">
    <form method="post" action="inventory_stock.php" target="_blank">
        <!-- Hidden input to pass the updateId -->
        <input type="hidden" name="updateId" value="<?= $id?>">
        <input type="hidden" name="itemName" value="<?= ($UpitemDesc_1 . ' ' . $UpitemDesc_2 . ' ' . $UpitemDesc_3) ?>">
        <input type="hidden" name="itemNumber" value="<?= $UpitemNumber?>">
        <input type="hidden" name="itemCode" value="<?= $UpitemCode?>">
        <input type="hidden" name="itemBrand" value="<?= $Upbrand?>">
        <input type="hidden" name="itemCategory" value="<?= $Upcategory?>">
        <input type="hidden" name="itemLocation" value="<?= $Uplocation?>">
        <input type="hidden" name="itemPrice" value="<?= $Upprice?>">
        <input type="hidden" name="itemUnits" value="<?= $Upunits?>">

        <input type="number" class="stockInOut" id="stockInOut" name="stockInOut" required><br>

        <div class="stock_controls">
            <select name="stockType" id="stockType">
                <option value="Stock Out">Stock Out</option>
                <option value="Stock In">Stock In</option>
            </select>    

            <button type="submit" class="stockBtn">Execute</button>
            <button type="button" class="RevBtn" onClick="Revert()">Revert</button>
        </div>
    </form>
</div>

<script>
function Revert() {
    // Reset the form fields
    document.querySelector('form').reset();
}
</script>


        <script>
function StockChanger() {

  
    // document.getElementById('units').value = '50';
     
    
    const units_element = document.getElementById('units');
    const change_element = document.getElementById('stockInOut');
    const type_element = document.getElementById('stockType');



    // Parse the values as numbers
    let units = parseInt(units_element.value);
    const change = parseInt(change_element.value);
    const type = type_element.value;


    // Check if values are valid numbers
    if (isNaN(units) || isNaN(change)) {
        alert("Please enter valid numbers for units and stock change.");
        return;
    }

    // Update the units based on stock type
    if (type === "Stock In") {
        console.log('In');
        const newval = units + change;
        let strNum = newval.toString();
        document.getElementById('units').value = strNum;
        alert(change + " units added");
    } else if (type === "Stock Out") {
        console.log('Out');
        
        const newval = units - change;
        let strNum = newval.toString();
        document.getElementById('units').value = strNum;
        alert(change + " units deducted");
        
    }

    // Update the units element with the new value
    // units_element.value = units;
}

function Revert(){
    location.reload();
}

function close(){
    window.close();
}


                </script>
    </body>

</html>