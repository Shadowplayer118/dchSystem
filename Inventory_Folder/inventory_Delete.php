<?php
include '../inventoryDb_connect.php';

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];

    
    
    $sqlfetch = "SELECT * FROM inventory2 WHERE inventory_Id = $id";
        $result = mysqli_query($con, $sqlfetch);
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

        
    $UpitemCode = "'".$UpitemCode. "'";
    $Upbrand = "'".$Upbrand. "'";
    $Upcategory = "'".$Upcategory. "'";
    $UpitemDesc_1 = "'".$UpitemDesc_1. "'";
    $UpitemDesc_2 = "'".$UpitemDesc_2. "'";
    $UpitemDesc_3 = "'".$UpitemDesc_3. "'";
    $Uplocation = "'".$Uplocation. "'";

    
        // Perform the deletion query here
        $sql = "DELETE FROM inventory2 WHERE inventory_id = ?;";
        $sqlCopy = "DELETE FROM inventory2 WHERE itemCode = $UpitemCode AND brand = $Upbrand AND category = $Upcategory AND itemDesc_1 = $UpitemDesc_1 AND itemDesc_2 = $UpitemDesc_2 AND itemDesc_3 = $UpitemDesc_3 AND location = $Uplocation;";
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
