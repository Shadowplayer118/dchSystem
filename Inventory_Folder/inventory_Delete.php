<?php
include '../inventoryDb_connect.php';

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];

    
        // Perform the deletion query here
        $sql = "DELETE FROM inventory2 WHERE inventory_id = ?;";
        $sqlCopy = "DELETE FROM inventory2 WHERE inventory_id = $id;";
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
