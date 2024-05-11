<?php
include '../inventoryDb_connect.php';
$id = $_GET['updateId'];

$sql = "SELECT * FROM inventory2 WHERE inventory_Id = $id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$image = $row['image'];
$inventory_Id = $row['inventory_Id'];
$itemNumber = $row['itemNumber'];
$itemCode = $row['itemCode'];
$brand = $row['brand'];
$category = $row['category'];
$itemDesc_1 = $row['itemDesc_1'];
$itemDesc_2 = $row['itemDesc_2'];
$itemDesc_3 = $row['itemDesc_3'];
$price = $row['price'];
$units = $row['units'];
$totalstockValue = $row['totalstockValue'];

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
    $totalstockValue = floatval($price) * intval($units);

    // Check if a new image is uploaded
    if ($_FILES['image']['size'] > 0) {
        // Generate a random and unique filename
        $randomFilename = uniqid() . '-' . bin2hex(random_bytes(8));
        $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $finalFilename = $randomFilename . '.' . $fileExtension;

        // Move the uploaded file to the 'images' folder with the final filename
        move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $finalFilename);

        // Update the image variable to the new filename
        $image = $finalFilename;
    }

    $sql = "UPDATE inventory2 SET itemNumber = '$itemNumber', itemCode = '$itemCode', brand = '$brand', category = '$category', itemDesc_1 = '$itemDesc_1', itemDesc_2 = '$itemDesc_2', itemDesc_3 = '$itemDesc_3', price = '$price', units = '$units', totalstockValue = '$totalstockValue', image = '$image' WHERE inventory_Id = $id";

    $result = mysqli_query($con, $sql);
    if ($result) {
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/> -->
          <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
          <link rel="stylesheet" type="text/css" href="../uniStyle.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <title>Update Inventory</title>
</head>
<body style="overflow-y: hidden">
<div class="container my-5">
    <h1>Update Inventory</h1>


    <form method="post" enctype="multipart/form-data">

    <div class="image-holder">

    <label for="image">Select Image:</label>
        <img id="preview" src="../images/<?= $image ?>" alt="Image Preview" style="display: block; max-width: 200px; max-height: 200px;">
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
                    preview.src = "../images/<?= $image ?>";
                }
            }
        </script>

    </div>

      


        <div class="fill-form">
        <div class="form-group">
            <label>Item Number</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item number" name="itemNumber"
                   autocomplete="off" value="<?= $itemNumber ?>">
        </div>
        <div class="form-group">
            <label>Item Code</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item item code" name="itemCode"
                   autocomplete="off" value="<?= $itemCode ?>">
        </div>
        <div class="form-group">
            <label>Item Brand</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item brand" name="brand"
                   autocomplete="off" value="<?= $brand ?>">
        </div>
        <div class="form-group">
            <label>Item Category</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item category" name="category"
                   autocomplete="off" value="<?= $category ?>">
        </div>
        <div class="form-group">
            <label>Description 1</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item description 1" name="itemDesc_1"
                   autocomplete="off" value="<?= $itemDesc_1 ?>">
        </div>
        <div class="form-group">
            <label>Description 2</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item description 2" name="itemDesc_2"
                   autocomplete="off" value="<?= $itemDesc_2 ?>">
        </div>
        <div class="form-group">
            <label>Description 3</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item description 3" name="itemDesc_3"
                   autocomplete="off" value="<?= $itemDesc_3 ?>">
        </div>
        <div class="form-group">
            <label>Item Price</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item price" name="price"
                   autocomplete="off" value="<?= $price ?>">
        </div>
        <div class="form-group">
            <label>Item Units</label>
            <br>
            <input type="text" class="form-control" placeholder="Enter item units" name="units"
                   autocomplete="off" value="<?= $units ?>">
        </div>
        <br>
        <button name="submit" class="btn btn-primary">Update</button>
        <a href="inventoryTable.php" class="btn btn-danger">Cancel</a>
        
        </div>
       
    </form>
</div>
</body>
</html>
