<?php
include '../inventoryDb_connect.php';

if(isset($_GET['supplierId'])){
    $id = $_GET['supplierId'];

    try {
        $sql = "delete from supplier where supplier_Id =$id";
        $result = mysqli_query($con,$sql);
        if($result){
            header("location:Supplier_Table.php");
        } else {
            die("Error deleting record: " . mysqli_error($con));
        }
    } catch (mysqli_sql_exception $e) {
        // Display a popup message for foreign key constraint error
        echo '<script>alert("Warning: This record cannot be deleted due to existing dependencies. It is still being reference in other tables.");</script>';
        echo '<script>setTimeout(function() { window.location.href = "Supplier_Table.php"; }, 1000);</script>';
    }
}
?>
