<?php
include '../inventoryDb_connect.php';

if(isset($_GET['deleteId'])){
    $id = $_GET['deleteId'];

    // Sanitize the input
    $id = mysqli_real_escape_string($con, $id);

    $sql = "DELETE FROM requisition WHERE requisition_id = '$id'";
    $result = mysqli_query($con, $sql);
    if($result){
    
   
   
          
        $result = mysqli_query($con, $sql);
        header("location:Requesiton_Manager.php");
        exit(); // Add exit after header to stop further execution
    } else {
        // Display an error message or redirect to an error page
        header("location:error.php");
        exit();
    }
}
?>
