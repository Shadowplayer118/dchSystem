<?php
include '../inventoryDb_connect.php';

if (isset($_POST['submit'])) {
    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = '../Images/' . $image_name;
        move_uploaded_file($image_tmp, $image_folder);
    } else {
        $image_name = 'gear.jpg'; 
    }

    // Sanitize POST data
    $itemNumber = mysqli_real_escape_string($con, $_POST['itemNumber']);
    $itemCode = mysqli_real_escape_string($con, $_POST['itemCode']);
    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $itemDesc_1 = mysqli_real_escape_string($con, $_POST['itemDesc_1']);
    $itemDesc_2 = mysqli_real_escape_string($con, $_POST['itemDesc_2']);
    $itemDesc_3 = mysqli_real_escape_string($con, $_POST['itemDesc_3']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $units = mysqli_real_escape_string($con, $_POST['units']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $totalstockValue = floatval($price) * intval($units);

    // Insert into inventory_warehouse
    $sql1 = "INSERT INTO inventory_warehouse (location_warehouse, requested_warehouse, ordered_warehouse, itemNumber_warehouse, itemCode_warehouse, brand_warehouse, category_warehouse, itemDesc_1_warehouse, itemDesc_2_warehouse, itemDesc_3_warehouse, price_warehouse, units_warehouse, totalstockValue_warehouse, image_warehouse)
    VALUES ('$location', 'None', 'None', '$itemNumber', '$itemCode', '$brand', '$category', '$itemDesc_1', '$itemDesc_2', '$itemDesc_3', '$price', '$units', '$totalstockValue', '$image_name');";

    if (mysqli_query($con, $sql1)) {
        // Log activity
        $sql2 = "INSERT INTO activity(query, date_performed) VALUES ('" . mysqli_real_escape_string($con, $sql1) . "', NOW())";
        if (mysqli_query($con, $sql2)) {
            echo "<script>alert('Data inserted successfully!');</script>";
            echo "<script>console.log(`" . addslashes($sql1) . "`);</script>";
            // Optionally, close the window
            echo "<script>window.close();</script>";
            exit();
        } else {
            echo 'Error logging activity: ' . mysqli_error($con);
        }
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
    <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
    <link rel="stylesheet" type="text/css" href="../uniStyle.css">
    <title>Add Inventory</title>
    <style>
        #preview {
            width: 200px;
            height: 200px;
            object-fit: cover;
            display: block;
        }
    </style>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <div class="add-container">
            <h1>Add Inventory</h1>
            
            <div class="form-group">
                <label for="image">Select Image:</label>
                <img id="preview" src="../Images/gear.jpg" alt="Image Preview">
                <br>
                <input type="file" id="image" name="image" onchange="previewImage(event)">
                <br>
                <script>
                    function previewImage(event) {
                        var input = event.target;
                        var preview = document.getElementById('preview');
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                            };
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            preview.src = '../Images/gear.jpg';
                        }
                    }
                </script>
            </div>

            <div class="add_form fill-form">
                <div class="form-group">
                    <label>Item Number</label>
                    <input type="number" class="form-control" placeholder="Enter item number" name="itemNumber" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Item Code</label>
                    <input type="text" class="form-control" placeholder="Enter item code" name="itemCode" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Item Brand</label>
                    <input type="text" class="form-control" placeholder="Enter item brand" name="brand" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Item Category</label>
                    <input type="text" class="form-control" placeholder="Enter item category" name="category" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Description 1</label>
                    <input type="text" class="form-control" placeholder="Enter item description 1" name="itemDesc_1" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Description 2</label>
                    <input type="text" class="form-control" placeholder="Enter item description 2" name="itemDesc_2" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Description 3</label>
                    <input type="text" class="form-control" placeholder="Enter item description 3" name="itemDesc_3" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Item Price</label>
                    <input type="number" class="form-control" placeholder="Enter item price" name="price" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Item Units</label>
                    <input type="number" class="form-control" placeholder="Enter item units" name="units" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" class="form-control" placeholder="Enter item location" name="location" autocomplete="off">
                </div>
                <br>
                
                <button name="submit" class="btn btn-primary btn-update">Submit</button> 
                <button name="cancel" class="btn btn-danger btn-cancel" onclick="closeTab()">Cancel</button>
            </div>

            <script>
                function closeTab() {
                    window.close();
                }
            </script>
        </div>
    </form>
</body>
</html>
