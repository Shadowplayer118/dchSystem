<?php
include '../inventoryDb_connect.php';

try {
    if(isset($_GET['deleteId'])){
        $id = $_GET['deleteId'];
        echo '<script>
                if(confirm("Are you sure you want to delete this item?")){
                    window.location.href = "delete.php?confirmedDeleteId='.$id.'";
                } else {
                    window.location.href = "inventoryTable.php";
                }
              </script>';
    }
} catch (mysqli_sql_exception $e) {
    // Handle the exception
    echo '<script>alert("Error: This item is still in use. It is either pending, requested, or a supplier is currently holding it."); window.history.back();</script>';
}
?>
