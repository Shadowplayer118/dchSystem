<?php
include '../inventoryDb_connect.php';

if(isset($_POST['submit'])){
    // Process the image upload
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_folder = '../Images/'.$image_name;

    move_uploaded_file($image_tmp, $image_folder);

    // Process the other form data
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

    // Insert data into the database
    $sql = "INSERT INTO inventory2 (requested,ordered,itemNumber, itemCode, brand, category, itemDesc_1, itemDesc_2, itemDesc_3, price, units, totalstockValue, image)
            VALUES ('None','None','$itemNumber', '$itemCode', '$brand', '$category', '$itemDesc_1', '$itemDesc_2', '$itemDesc_3', '$price', '$units', '$totalstockValue', '$image_name')";

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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" /> -->
    <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
          <link rel="stylesheet" type="text/css" href="../uniStyle.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script> -->
 
    <title>Add Inventory</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <div class="container my-5">
            <h1>Add Inventory</h1>


            <div class="form-group">
                
            <div class="image_box">
            <label for="image">Select Image:</label>
                <img id="preview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px;">
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
                        reader.readAsDataURL(input.files[0]);
                    }
                </script>

            </div>
           

                <div class="add_form">
                <label>Item Number</label>
                <input type="text" class="form-control" placeholder="Enter item number" name="itemNumber" autocomplete="off">

                <div class="form-group">

                    <label>Item Code</label>
                    <input type="text" class="form-control" placeholder="Enter item item code" name="itemCode" autocomplete="off">

                    <div class="form-group">
                        <label>Item Brand</label>
                        <input type="text" class="form-control" placeholder="Enter item brand" name="brand" autocomplete="off">

                        <div class="form-group">
                            <label>Item Category</label>
                            <input type="text" class="form-control" placeholder="Enter item category" name="category" autocomplete="off">

                            <div class="form-group">
                                <label>Description 1</label>
                                <input type="text" class="form-control" placeholder="Enter item description 1" name="itemDesc_1" autocomplete="off">

                                <div class="form-group">
                                    <label>Description 2</label>
                                    <input type="text" class="form-control" placeholder="Enter item description 2" name="itemDesc_2" autocomplete="off">

                                    <div class="form-group">
                                        <label>Description 3</label>
                                        <input type="text" class="form-control" placeholder="Enter item description 3" name="itemDesc_3" autocomplete="off">

                                        <div class="form-group">
                                            <label>Item Price</label>
                                            <input type="text" class="form-control" placeholder="Enter item price" name="price" autocomplete="off">

                                            <div class="form-group">
                                                <label>Item Units</label>
                                                <input type="text" class="form-control" placeholder="Enter item units" name="units" autocomplete="off">

                                                <br>
                                                <button name="submit" class="btn btn-primary submit">Submit</button> <button name="cancel" class="btn btn-danger cancel" onclick="closeTab()">Cancel</button>

                </div>
                
                                                <script>
                                                    function closeTab() {
                                                        window.close();
                                                    }
                                                </script>
    </form>
</div>
</body>
</html>
