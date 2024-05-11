<?php
include '../inventoryDb_connect.php';

if(isset($_GET['deleteId'])){
    $id = $_GET['deleteId'];

    $sql = "delete from price_list where price_list_Id =$id";
    $result = mysqli_query($con,$sql);
    if($result){
        header("location:Pricelist_Table.php");
    }

    else{
        die(mysqli_error($con));
    }
}
?>