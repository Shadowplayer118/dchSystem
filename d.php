
<?php


session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: loginForm.php');
    exit();
}

include 'inventoryDb_connect.php';

$filterValue = '';

if (isset($_GET['filter'])) {
    $filterValue = $_GET['filter'];
    $sql = "SELECT * FROM inventory2 WHERE brand LIKE '%$filterValue%' OR category LIKE '%$filterValue%' OR itemCode LIKE '%$filterValue%' OR itemNumber LIKE '%$filterValue%' OR ordered LIKE '%$filterValue%' OR requested LIKE '%$filterValue%' inventory_Id DESC";
} else {
    $sql = "SELECT * FROM inventory2 ORDER BY inventory_Id DESC";
}

$sql = "SELECT COUNT(*) AS orderCount FROM orders";
$result = mysqli_query($con, $sql); // Assuming $conn is your database connection

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $orderCount = $row['orderCount'];
    
} else {
    echo "Error: " . mysqli_error($con);
}


$sql2 = "SELECT COUNT(*) AS ReqCount FROM requisition";
$result = mysqli_query($con, $sql2); // Assuming $conn is your database connection

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $ReqCount = $row['ReqCount'];
    
} else {
    echo "Error: " . mysqli_error($con);
}


$sql3 = "SELECT COUNT(*) AS InvCount FROM inventory2";
$result = mysqli_query($con, $sql3); // Assuming $conn is your database connection

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $InvCount = $row['InvCount'];
    
} else {
    echo "Error: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
          <link rel="stylesheet" type="text/css" href="uniStyle.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <title>Home Page</title>



<div class="header">
<h1 class = "title">DCH Inventory </h1>
 <div class="link-container">
    <a href="HomePage.php"  class="index-link">Home</a>
    <br>
    </div>

    <div class="link-container">
    <a href="Inventory_Folder/inventoryTable.php"  class="index-link">Inventory</a>
    <br>
    </div>

    <div class="link-container">
    <a href="Order_Folder/Order_Manager.php" class="index-link">Manage Orders</a>
    <br>
    </div>



    <div class="link-container">
    <a href="Requesition_Folder/Requesiton_Manager.php"  class="index-link">Manage Requesitions</a>
    <br>
    </div>

    <div class="link-container">
    <a href="Supplier_Folder/Supplier_Table.php"  class="index-link">Suppliers</a>
    <br>
    </div>

    <div class="link-container">
    <a href="PriceList_Folder/PriceList_Table.php"  class="index-link">Price List</a>
    <br>
    </div>

    <div class="link-container">
    <a href="logout.php" class="index-link">Log Out</a>

</div>

    
</head>


<body>
    <div class="box-row">
        <a href="Inventory_Folder/inventoryTable.php" class="box">
            <div class="box-content">Inventory</div>
            <div class="box-number"><?php echo $InvCount ?></div>
        </a>
        
        <a href="Requesition_Folder/Requesiton_Manager.php" class="box">
            <div class="box-content">Requisitions</div>
            <div class="box-number"><?php echo $ReqCount ?></div>
        </a>
        
        <a href="Order_Folder/Order_Manager.php" class="box">
            <div class="box-content">Orders</div>
            <div class="box-number"><?php echo $orderCount ?></div>
        </a>
    </div>
</body>



</html>
