<?php
include '../inventoryDb_connect.php';

if(isset($_GET['deleteId'])){
    $id = $_GET['deleteId'];

    $sql = "delete from orders where order_Id =$id";
    $result = mysqli_query($con,$sql);
    if($result){
   
   
   
          
        $result = mysqli_query($con, $sql);
        header("location:Order_Manager.php");
    }

    else{
        die(mysqli_error($con));
    }
}
?>