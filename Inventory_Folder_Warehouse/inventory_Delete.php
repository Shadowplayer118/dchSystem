<?php
include '../inventoryDb_connect.php';

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];


    $sqlfetch = "SELECT * FROM inventory_warehouse WHERE inventory_warehouse_Id = $id";
    $result = mysqli_query($con, $sqlfetch);
    $row = mysqli_fetch_assoc($result);
    $image = $row['image_warehouse'];
    $Upinventory_Id = $row['inventory_warehouse_Id'];
    $UpitemNumber = $row['itemNumber_warehouse'];
    $UpitemCode = $row['itemCode_warehouse'];
    $Upbrand = $row['brand_warehouse'];
    $Upcategory = $row['category_warehouse'];
    $UpitemDesc_1 = $row['itemDesc_1_warehouse'];
    $UpitemDesc_2 = $row['itemDesc_2_warehouse'];
    $UpitemDesc_3 = $row['itemDesc_3_warehouse'];
    $Upprice = $row['price_warehouse'];
    $Upunits = $row['units_warehouse'];
    $Uplocation = $row['location_warehouse'];
    $UptotalstockValue = $row['totalstockValue_warehouse'];

    $UpitemCode = "'".$UpitemCode. "'";
    $Upbrand = "'".$Upbrand. "'";
    $Upcategory = "'".$Upcategory. "'";
    $UpitemDesc_1 = "'".$UpitemDesc_1. "'";
    $UpitemDesc_2 = "'".$UpitemDesc_2. "'";
    $UpitemDesc_3 = "'".$UpitemDesc_3. "'";
    $Uplocation = "'".$Uplocation. "'";

    
        // Perform the deletion query here
        $sql = "DELETE FROM inventory_warehouse WHERE inventory_warehouse_id = ?;";
        $sqlCopy = "DELETE FROM inventory_warehouse WHERE itemCode_warehouse = $UpitemCode AND brand_warehouse = $Upbrand AND category_warehouse = $Upcategory AND itemDesc_1_warehouse = $UpitemDesc_1 AND itemDesc_2_warehouse = $UpitemDesc_2 AND itemDesc_3_warehouse = $UpitemDesc_3 AND location_warehouse = $Uplocation;";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {

                // Log activity
                $sql2 = "INSERT INTO activity(query, date_performed) VALUES ('" . mysqli_real_escape_string($con, $sqlCopy) . "', NOW())";
                if (mysqli_query($con, $sql2)) {
                    echo '<script>
                    alert("Item deleted successfully.");
                    window.location.href = "inventoryTable.php";
                  </script>';
                    exit();
                } else {
                    echo 'Error logging activity: ' . mysqli_error($con);
                }
          
        } else {
            echo '<script>
                    alert("Error: Unable to delete the item.");
                    window.location.href = "inventoryTable.php";
                  </script>';
        }

        $stmt->close();
        $con->close();
    
} else {
    // Redirect back if deleteId is not set
    header("Location: inventoryTable.php");
    exit();
}
?>
